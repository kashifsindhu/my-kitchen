            $customer = User::find($id);

            $products= Product::all();
            $orders = $products->map(function($p) use($customer) {                   
                $p->productscount = ProductOrder::where('product_id', $p->id)->where('user_id',$customer->id )->latest()->get()->groupBy(function($date) {
                return Carbon::parse($date->updated_at)->startOfWeek()->format('d-m-Y');
                });
                return $p;                
            });
            $array1=array();
            $array2=array();
            $resultant=array();
            $statementvalue=0;

            foreach ($orders as $key => $value) 
            {
                $productPrice= $value->price;
                foreach ($value->productscount as $key => $value1) 
                {    
                    $date = Carbon::parse($key);
                    $start = $date->startOfWeek()->format('d-m-Y'); // 2016-10-17 00:00:00.000000
                    $end = $date->endOfWeek()->format('d-m-Y');
                    $start1 = $date->startOfWeek()->format('Y-m-d'); // 2016-10-17 00:00:00.000000
                    $end1 = $date->endOfWeek()->format('Y-m-d');
                    $regionName=$value1->first()->region_name;
                    if(!in_array($key,$array1))
                    {     
                            array_push($array1,$key);
                            $statementvalue=$value1->sum('quantity')*$productPrice;
                            $array2= [
                                'start' => $start,
                                'end'   => $end,
                                'start1' => $start1,
                                'end1'   => $end1,
                                'region' =>$regionName,
                                'statementPrice' => $statementvalue,
                            ];
                            array_push($resultant,$array2);
                    }
                    else
                    {  
                       foreach ($resultant as $key => $value) 
                       {
                            if($value['start'] == $start && $value['end'] == $end)
                            {
                            $resultant[$key]['statementPrice']=$value['statementPrice']+$value1->sum('quantity')*$productPrice;
                            }
                        }
                    }        
                }
            }