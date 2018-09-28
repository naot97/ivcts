<style type="text/css">
    .table tbody tr td{
        padding: 0px 0px 0px 0px;
    }
    .table thead{
        background-color: #F0E68C;
    }
</style>
<div class=" p-t-10">
    <h4 class="card-header text-white">List Effort</h4>
    <table class="table table-hover table-striped table-bordered table-responsive" style="margin-top: 5px !important;"   dt-options="dtOptions" cellspacing="0" width="100%">
        <thead>
            <tr>
                <div><th>#</th>
                <th>Level</th></div>
                <th>Number of employee</th>
            </tr>
           
        </thead>
        <tbody>     
                <tr ng-repeat='level in tableList' ng-dbclick=''>
                    <td class="index" ><a>{{$index + 1}}</a></td>
                    <td>{{level.levelName}}</td>
                    <td onclick="$('#detail').show();$('#detail').dropdown('toggle')" ng-click="detail(level.levelID)"><i  style="color: {{employeeJson[level.levelID].length > 0 ? 'red' : ''}}">{{employeeJson[level.levelID].length}}</i>
                    </td>
                </tr>
        </tbody>
        <tfoot>
            <tr style="text-align: left; font-weight: bold; color: green;">
                <td></td>
                <td>All</td>
                <td>{{sumEmployee}}</td>
            </tr>
        </tfoot>
        
    </table>
     
</div>
