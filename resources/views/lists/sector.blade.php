@extends('admin')
@section('content')
    <div class="site_body">
        <section class="site_list_view">

            <div class="section_hdr clearfix">
                <h1 class="site_page_title">All Organization</h1>

            <span class="section_hdr_btns_wrp"><a href="{{ URL::route('createSector') }}"
                                                  class="btn btn_green">Add new</a></span>

            </div>


            <div class="site_tabling">
                <table cellpadding="0" cellspacing="0">

                    <thead>


                    <tr>
                        <th>S. N.</th>
                        <th>Sector Name</th>
                        <th>Status</th>
                        <th class="actions">Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php $i = 2; $j = 1; ?>
                    @foreach($dataList as $row)
                        <?php
                        if ($row->parent_id > 0):
                            continue;
                        endif;

                        $sectorLink = url('/sectors/' . $row->id);
                        $editLink = url('/sectors/edit/' . $row->id);
                        $deleteLink = url('/sectors/delete/' . $row->id);
                        $k = 1;
                        ?>
                        <tr>
                            <td>{{ $j }}</td>
                            <td><a href="{{$sectorLink}}"> <strong> {{ $row->name }} </strong> </a></td>
                            <td> {{ $row->status }} </td>
                            <td>
                                <div class="action_icon"><i class="fa fa-cogs" aria-hidden="true"></i>

                                    <!--ActionBtns-->
                                    <span class="actions_wrapp">
                                        <a href="{{$editLink}}" class="fa fa-pencil-square-o" aria-hidden="true"></a>
                                        <a href="{{$sectorLink}}" class="fa fa-eye" aria-hidden="true"></a>
                                        <a onclick="return confirm('Are you sure? You can\'t undo this action.')"
                                           href="{{$deleteLink}}" class="fa fa-trash-o" aria-hidden="true"></a>
                                    </span>

                                </div>
                            </td>

                        </tr>

                        @foreach($dataList as $child)
                            <?php

                            $sectorLink = url('/sectors/' . $child->id);
                            $editLink = url('/sectors/edit/' . $child->id);
                            $deleteLink = url('/sectors/delete/' . $child->id);
                            ?>
                            @if($child->parent_id == $row->id)

                                <tr>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ integerToRoman($k) }}</td>
                                    <td><a href="{{$sectorLink}}">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-{{ $child->name }} </a>
                                    </td>
                                    <td> {{ $child->status }} </td>

                                    <td class="actions">
                                        <div class="action_icon"><i class="fa fa-cogs" aria-hidden="true"></i>

                                            <!--ActionBtns-->
                                    <span class="actions_wrapp">
                                        <a href="{{$editLink}}" class="fa fa-pencil-square-o" aria-hidden="true"></a>
                                        <a href="{{$sectorLink}}" class="fa fa-eye" aria-hidden="true"></a>
                                        <a onclick="return confirm('Are you sure? You can\'t undo this action.')"
                                           href="{{$deleteLink}}" class="fa fa-trash-o" aria-hidden="true"></a>
                                    </span>

                                        </div>

                                    </td>
                                </tr>
                                <?php $k++; ?>
                            @endif
                        @endforeach
                        <?php $j++; ?>

                    @endforeach

                    </tbody>

                    <tfoot>

                </table>
                <?php
                $view = Request::get('view');
                if (!$view) {
                    $view = 10;
                }
                ?>
                <div class="grid_pagination">
                    <ul class="ftr_sort">
                        <li class="pull-left">
                            Showing <strong>{{ $dataList->currentPage() }} </strong> of {{ $dataList->lastPage() }}
                        </li>
                        <li>|</li>
                        <li><span>Show</span><span>
                            <select id="row-view-select">
                                <option {{ $view==10?'selected':'' }} value="{{ url('sectors?view=10') }}">10</option>
            <option {{ $view==25?'selected':'' }} value="{{ url('sectors?view=25') }}">25</option>
            <option {{ $view==50?'selected':'' }} value="{{ url('sectors?view=50') }}">50</option>
            <option {{ $view==100?'selected':'' }} value="{{ url('sectors?view=100') }}">100</option>
                            </select>
                        </span></li>
                    </ul>
                    <ul>
                        <li><a href="{!! $dataList->previousPageUrl()!!}">Prev</a></li>
                        <li>{!!  str_replace('/?', '?', $dataList->appends(['view' => $view ])->render()) !!}</li>
                        <li><a href="{!! $dataList->nextPageUrl()!!}">Next</a></li>

                    </ul>
                </div>


            </div>

    </div>
    <?php
    function integerToRoman($integer)
    {
        // Convert the integer into an integer (just to make sure)
        $integer = intval($integer);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = array('M' => 1000,
                'CM' => 900,
                'D' => 500,
                'CD' => 400,
                'C' => 100,
                'XC' => 90,
                'L' => 50,
                'XL' => 40,
                'X' => 10,
                'IX' => 9,
                'V' => 5,
                'IV' => 4,
                'I' => 1);

        foreach ($lookup as $roman => $value) {
            // Determine the number of matches
            $matches = intval($integer / $value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman, $matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }
    ?>
@stop



         