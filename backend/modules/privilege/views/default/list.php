<div class="table-responsive">
    <h4 class="card-header text-white"> Privilege List</h4>
    <table datatable="ng" dt-options="dtOptions" class="display nowrap table table-hover table-striped table-bordered"  width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Privilege Name</th>
                <th>Function ID</th>      
                <th>Group</th>   
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="pri in listPri" ng-dblclick="rowSelected($index)"> 
                <td style="width: 1%;vertical-align: middle; text-align: center" >
                    <a href="#">{{$index + 1}}<a/>
                </td>
                <td>
                    {{pri.name}}
                </td>
                <td>
                    {{pri.functionId}}
                </td>
                <td>
                    {{GetNameElement(pri.groupId, 'gp')}}
                </td>
                <td>
                    {{pri.link}}
                </td>
            </tr>
        </tbody>
    </table>
</div>
