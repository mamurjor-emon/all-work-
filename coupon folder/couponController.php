/**
     * coupon matcha form user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function match_discount(Request $req)
    {
        if ($req->ajax()) {

            // get coupon information with offerDiscount  CouponDiscount table
            $data = Coupon::with('offerDiscount')->where('coupon_code', $req->coupon)->first();
            if ($data != '') {
                $service_id = $data['offerDiscount'][0]['service_ids'];
                $decoded_data = json_decode($service_id);
                $find_service_id = array_search($req->service_id_for_match,$decoded_data ,true);
                if ($find_service_id != '') {
                    if($data->status == 1){


                        // not work in recurning balance for now time
                        // $recunnig_data = Service::with('serviceKeys')->where('id',$req->service_id_for_match)->get();
                        // // dd($recunnig_data[0]->recurring);
                        // if($recunnig_data[0]->recurring==1){

                        //     $discount_duration = Coupon::select('discount_duration')->where('coupon_code', $req->coupon)->first();
                        //     $discount_duration = $discount_duration->discount_duration;

                        //     if($discount_duration == 2){
                        //     //     $get_user_id = Invoice::where('coupon_code', $req->coupon)->get();
                        //     //     foreach($get_user_id as $user){
                        //     //        $get_user = User::where('id',$user->user_id)->get();
                        //     //        if($get_user){
                        //     //         return response()->json([
                        //     //             'status' => 'error',
                        //     //             'message' => 'Already Usesed'
                        //     //         ]);
                        //     //        }else{
                        //     //         dd('now create');
                        //     //        }
                        //     //     }
                        //     }
                        //     else{
                        //         // Unlimited Payemnt
                        //     //    dd("Unlimited");
                        //     }
                        // }

                        $count_of_uses_coupon = Invoice::where('coupon_code', $req->coupon)->count();
                        $how_number_use = $data->how_number_use;
                        $is_number_use = $how_number_use - $count_of_uses_coupon;
                        $is_cheak_date = $data->expiry_date;
                        $now_date = now()->format('m/d/Y');
                        //
                        if ($is_cheak_date >= $now_date || $is_cheak_date == null && $is_number_use > 0 || $how_number_use == null) {
                            // convart string data in integer
                        $replace_total = str_replace(',', '', $req->amount);
                        $total_amount = (int)($replace_total);
                        $discount_type = $data->discount_type;

                        if ($discount_type == 1) {
                            $discount_data =  $data['offerDiscount'][0]['discount'];
                            $discount_amount = (int)($discount_data);
                            $grand_total = $total_amount - $discount_amount;
                            if ($grand_total > 0) {
                                return response()->json([
                                    'status' => 'success',
                                    'discount_amount' => $discount_amount,
                                    'grand_total' => $grand_total
                                ]);
                            } else {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => 'Please  select a service'
                                ]);
                            }

                        }else {
                            // work in discount type == 2 (persentage)
                            $discount_data =  $data['offerDiscount'][0]['discount'];
                            $discount_amount = (int)($discount_data);


                            $discount_amount = ($discount_amount / 100) * $total_amount;
                            $grand_total = $total_amount - $discount_amount;
                            if ($grand_total > 0) {
                                return response()->json([
                                    'status' => 'success',
                                    'discount_amount' => $discount_amount,
                                    'grand_total' => $grand_total
                                ]);
                            } else {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => 'place select a service'
                                ]);
                            }

                        }
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Coupon date expiry'
                                ]);
                        }

                    }else{
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Coupon is inactive now !'
                            ]);
                    }






                } else {
                    return response()->json([
                    'status' => 'error',
                    'message' => 'Please select your service'
                    ]);
                }


            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please,Enter Your Coupon'
                ]);
            }
        }
    }
