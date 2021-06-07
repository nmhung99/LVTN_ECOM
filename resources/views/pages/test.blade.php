@if(Session::has('brandsubcat'))
                            <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
                                <h4 class="sidebar-widget-title">Nhãn Hàng </h4>
                                <div class="shop-catigory">
                                    <ul>
                                        
                                            @php
                                                $idbrand = Session::get('brandsubcat')['idcat'];
                                                $idbrandsubcat = DB::table('brands')->where('category_id',$idbrand)->get();
                                                
                                            @endphp
                                            @foreach($idbrandsubcat as $item)
                                            <li><a href="{{asset('/products/brands/'.$item->id)}}">{{$item->brand_name}}</a></li>
                                            @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if(Session::has('brandcat'))
                            <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
                                <h4 class="sidebar-widget-title">Nhãn Hàng </h4>
                                <div class="shop-catigory">
                                    <ul>

                                        @php
                                        $idbrand = Session::get('brandcat');
                                        $idbrandsubcat = DB::table('brands')->where('category_id',$idbrand)->get();

                                        @endphp
                                        @if($idbrandsubcat->count() == 0)
                                            <li>Không Có</li>
                                        @else
                                        @foreach($idbrandsubcat as $item)
                                        <li><a href="{{asset('/products/brands/'.$item->id)}}">{{$item->brand_name}}</a></li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            @endif