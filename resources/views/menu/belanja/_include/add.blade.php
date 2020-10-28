                                                   <tr>
                                                        <td style="width: 12%;font-size:13px"> 
                                                       <select name="barang[]" style="font-size:13px" class="form-control select">
                                                            @foreach ($produksi as $pd)
                                                        <option class="produk-{{$pd->id}}" data-belanja="{{$pd->kuantitas-$pd->tersedia()}}" value="{{$pd->id}}">{{$pd->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>    
                                                
                                                  
                                               
                                            
                                                    <td style="width: 13%"><input autocomplete="off" style="font-size:13px" type="text" class="kuantitas-input form-control input-sm" name="kuantitas[]"  onkeyup="qyt();" ></td>
                                                            
                                             
                                                <td><input autocomplete="off" type="text" style="font-size:13px" class="harga-input form-control input-sm numberFormat" name="harga[]"  onkeyup="rp();hg()"></td >
                                                    
                                                    <td>
                                                        <input autocomplete="off" type="text" style="font-size:13px" readonly class="total-input form-control input-sm numberFormat" name="total[]" onkeyup="rp();" value="0"></td>

                                                <td>
                                                    <div class="row " style="display: flex;flex-direction: row;justify-content: center">
                                                        <input autocomplete="off" type="text" style="font-size:13px" class="form-control   dibayar-input input-sm numberFormat hidden" name="dibayar[]" onkeyup="rp();" value="0">
                                                            <a    style="cursor: pointer" class="btn " ><input type="checkbox" class="cekbox"</a>
                                                                               
                                                                            
                                                    </div>
                                                </td>
                                                        
                                                        <td class="remove text-white">
                                                            
                                                    <a    style="cursor: pointer" class="remove-tr btn btn-sm btn-circle btn-danger"><i class="fas fa-trash remove"></i></a>
                                                </td>
                                            </tr>