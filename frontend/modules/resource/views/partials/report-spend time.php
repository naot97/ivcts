<style type="text/css">
    #tblSpendTime thead tr th {
        text-align: center;
        font-weight: bold;
    }
    #tblSpendTime tbody tr {
        cursor: pointer;
    }
    #tblSpendTime tbody tr td {
        text-align: left;
    }
    #tblSpendTime tbody tr td a{
        color: #4680ff;
    }
    #tblSpendTime tbody .sumCol {
        background-color: green;
        cursor: auto;
    }
    #tblSpendTime tbody .sumCol:hover {
        background-color: green;
        cursor: auto;
    }
    #tblSpendTime tbody .sumCol td {
        color: white;
    }
    #tblSpendTime tbody tr .tdblock {
        cursor: auto;
        vertical-align: middle;
    }
    #tblSpendTime tbody tr:hover {
        background-color: #DDDDDD;
    }
    #tblSpendTime tbody tr:hover > .tdblock {
        background-color: #fff;
    }
</style>

<div class="table-responsive">
    <h4 class="card-header text-white">Spend Time List</h4>
    <br>
    <table  id="tblSpendTime" class="display nowrap table table-bordered table-responsive" cellspacing="0" width="100%" >
        <thead>
            <tr>
               <th colspan="1000"> {{p.month + '/' + p.year + '--' + p.workingHour +' h'}} </th>
            </tr>
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Section</th>
                <th rowspan="2">Employee</th>
                <th ng-repeat='project in lstProject' colspan="4">{{project.projectName}} </th>           
            </tr>
            <tr>
                <th ng-repeat="n in [] | range:lstProject.length*4">
                    {{
                        $index % 4 == 0 ? 'Effort' : $index % 4 == 1 ? 'Rank' : $index % 4 == 2 ?'Type' : 'OT' ;
                    }}
                </th>
            </tr>
        </thead>
        <tbody >         
            <tr ng-repeat="employee in lstEmployee">
                <td class="index">{{$index + 1}}</td>
                <td>{{employee.sectionID}}</td>
                <td>{{employee.employeeName}}</td>
            </tr>
        </tbody>
    </table>
</div>