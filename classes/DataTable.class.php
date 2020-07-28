<?php

class DataTable
{
    public static function getTable(
        $result_array,
        $results_per_page,
        $page,
        $script_add,
        $script_edit,
        $script_delete,
        $script_search,
		$script_detail,
		$script_tasklist
    ) {
        $dataToEcho = "";
        $result_num = count($result_array);

        if ($result_num > 0) {
            $result_columns = array_keys($result_array[0]);
    
            $dataToEcho .=
            "<table id='user-table' class='table table-striped table-hover' style='word-wrap:break-word; table-layout:fixed;'>
                <thead><tr>
                <th><span class='custom-checkbox'>
                    <input type='checkbox' id='selectAll' onchange='selectAll(this)'>
                    <label for='selectAll'></label>
                </span></th>";
            for ($i = 0; $i < count($result_columns); $i++) {
                $dataToEcho .= "<th>".$result_columns[$i]."</th>";
            }
            $dataToEcho .= "<th>Actions</th>
                </tr></thead>
                <tbody>";

            $total_pages = ceil($result_num / $results_per_page);
            if ($page > $total_pages) {
                $page = $total_pages;
            }
    
            $start_from = ($page - 1) * $results_per_page;
            $end_to = $start_from;
    
            for ($i = 0; $i < $results_per_page; $i++) {
                if ($page == $total_pages && $i == $result_num - $start_from) {
                    break;
                }
                $end_to++;
                $id = $result_array[$start_from + $i]['Id'];

                $dataToEcho .=
                "<tr id='row".$id."'>
                    <td><span class='custom-checkbox'>
                        <input type='checkbox' id='checkbox".$id."' onchange='deselectSelectAllBtn(this)' value='".$id."'>
                        <label for='checkbox".$id."'></label>
                    </span></td>";

                for ($j = 0; $j < count($result_columns); $j++) {
                    $data = $result_array[$start_from + $i][$result_columns[$j]];
                    $dataToEcho .= "<td>".($data == null ? "No record" : $data)."</td>";
                }

                $dataToEcho .=
                    "<td>
                        <a href='".BASE_URL."$script_edit?id=".$id."' class='edit' data-toggle='modal'><i class='material-icons' title='Edit'>&#xE254;</i></a>
                        <a href='#' onclick='deleteById(".$id.")' class='delete' data-toggle='modal'><i class='material-icons' title='Delete'>&#xE872;</i></a>
						<a href='".BASE_URL."$script_detail?id=".$id."' class='detail' data-toggle='modal'><i class='material-icons' title='Details'>&#xE254;</i></a>
						<a href='".BASE_URL."$script_tasklist?id=".$id."' class='detail' data-toggle='modal'><i class='material-icons' title='Details'>&#xE254;</i></a>
                    
                    </td>
                </tr>";
            }
    
            $dataToEcho .= "</tbody></table> 
                <div class='clearfix' style='display: flex;'>
                    <div style='flex: 1'>
                        <span class='hint-text'>Showing 
                            <b>".($start_from + 1)."</b> to 
                            <b>".$end_to."</b> of 
                            <b>".$result_num."</b> entries
                        </span>
                    </div>
    
                    <div style='flex: 1;'>
                        <ul class='pagination' style='float: right'>
                            <li class='page-item'>
                                <a id='page-link-previous' style='cursor: pointer;'>Previous</a>
                            </li>";
    
            //Pages
            for ($i=1; $i <= $total_pages; $i++) {
                $dataToEcho .= "<li class='page-item";
                if ($i == $page) {
                    $dataToEcho .= " active";
                }
                $dataToEcho .= "'><a class='page-link' style='cursor: pointer;'>".$i."</a></li>";
            }
    
            //Next
            $dataToEcho .=
                            "<li class='page-item'>
                                <a id='page-link-next' style='cursor: pointer;'>Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>";
            $dataToEcho .= DataTable::getSeachPageFunction($script_search, ($page == 1) ? $total_pages : ($page - 1), $results_per_page);
        } else {
            $dataToEcho .= 'Data Not Found';
        }
        return $dataToEcho;
    }

    public static function getSeachPageFunction($script_search, $page, $results_per_page){
        return "
            <script type='text/javascript'>
            $(document).ready(function(){
                $('.page-link').click(function(){
                    $.ajax({
                        url: '$script_search',
                        type: 'POST',
                        data: {
                            search: $('#search').val(), 
                            page: parseInt($(this).text()),
                            results_per_page: $results_per_page
                        },
                        success: function(html) {
                            $('#result').html(html);
                        }
                    });
                });
            
                $('#page-link-previous').click(function(){
                    $.ajax({
                        url: '$script_search',
                        type: 'POST',
                        data: {
                            search: $('#search').val(), 
                            page: $page,
                            results_per_page: $results_per_page
                        },
                        success: function(html) {
                            $('#result').html(html);
                        }
                    });
                });
            
                $('#page-link-next').click(function(){
                    $.ajax({
                        url: '$script_search',
                        type: 'POST',
                        data: {
                            search: '', 
                            page: $page,
                            results_per_page: $results_per_page
                        },
                        success: function(html) {
                            $('#result').html(html);
                        }
                    });
                });
            });
            </script>
        ";
    }
}