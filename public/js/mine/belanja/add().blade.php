<tr>
                                                   
                                                        
                                                    <td style="width: 13%;" ><input autocomplete="off" style="font-size:12px" type="text" class=" form-control input-sm" name="faktur[]" placeholder="isi Jika Ada" ></td>

                                                        <td style="width: 12%;font-size:12px"> 
                                                        <select name="barang[]" style="font-size:12px" class="form-control">
                                                            @foreach ($produksi as $pd)
                                                        <option value="{{$pd->id}}" >{{$pd->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>    
                                                
                                                     <td style="width: 13%;"> 
                                                        <select name="suplier[]" style="font-size:12px" class="form-control">
                                                            @foreach ($suplier as $s)
                                                        <option value="{{$s->id}}">{{$s->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>    
                                               
                                            
                                                    <td style="width: 13%"><input autocomplete="off" style="font-size:12px" type="text" class="kuantitas-input form-control input-sm" name="kuantitas[]"  onkeyup="qyt();bayars('kuantitas')" value="{{isset($p->gudang->belanja)?$p->kuantitas - $p->gudang->belanja->sum('tersedia'):''}}"></td>
                                                            
                                             
                                                <td><input autocomplete="off" type="text" style="font-size:12px" class="harga-input form-control input-sm numberFormat" name="harga[]"  onkeyup="hs();rp();bayars('harga')"></td >
                                                    
                                                    <td><input autocomplete="off" type="text" style="font-size:12px" readonly class="total-input form-control input-sm numberFormat" name="total[]" onkeyup="rp();" value="0"></td>

                                                <td><input autocomplete="off" type="text" style="font-size:12px" class="form-control dibayar-input input-sm numberFormat" name="dibayar[]" onkeyup="rp();" value="0"></td>

                                                <td class="remove text-white">
                                                         <a    style="cursor: pointer" class="lunas-tr badge badge-sm badge-circle badge-success "><i class="fas fa-check lunas"></i>
                                                         </a>
                                                    <a    style="cursor: pointer" class="remove-tr badge badge-sm badge-circle btn-danger"><i class="fas fa-trash remove"></i></a>
                                                </td>
                                            </tr>