<style type="text/css">
    #tblProject thead tr th {
        text-align: center;
        font-weight: bold;
    }
    #tblProject tbody tr {
        cursor: pointer;
    }
    #tblProject tbody tr td {
        text-align: left;
    }
    #tblProject tbody tr td a{
        color: #4680ff;
    }
    #tblProject tbody .sumCol {
        background-color: green;
        cursor: auto;
    }
    #tblProject tbody .sumCol:hover {
        background-color: green;
        cursor: auto;
    }
    #tblProject tbody .sumCol td:last-child {
        color: white;
    }
    #tblProject tbody tr .tdblock {
        cursor: auto;
        vertical-align: middle;
    }
    #tblProject tbody tr:hover {
        background-color: #DDDDDD;
    }
    #tblProject tbody tr:hover > .tdblock {
        background-color: #fff;
    }
</style>

<div class="table-responsive">
    <h4 class="card-header text-white">Project Sale Plan List</h4>
    <br>
    <table id="tblProject" class="display nowrap table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Project</th>      
                <th>Section</th>
                <th>Period</th>
                <th>Rank</th>
                <th>Type</th>
                <th>Effort</th>                   
            </tr>
        </thead>
        <tbody >         
            <tr ng-repeat-start="prj in lstProjectSaleplan" 
                ng-dblclick="rowSelected(prj.saleplanID)">              
                <td class="index" style=" vertical-align: middle; text-align: center" onclick="$('#tagHistory').show();$('#tagHistory').dropdown('toggle')" ng-click="GetLogs($index)">
                    <a href="#">{{$index + 1}}<a/>
                </td>               
                <td ng-if="(count = CountProjectSaleplan(prj.projectID)) > 1" rowspan="{{count}}" class="tdblock"
                    ng-dblclick="">
                    {{GetNameElement(prj.projectID, 'pr')}}
                </td>           
                <td ng-if="count === 1">
                    {{GetNameElement(prj.projectID, 'pr')}}
                </td>        
                <td ng-if="count === 0" hidden="hidden">
                    {{GetNameElement(prj.projectID, 'pr')}}
                </td>        
                <td>
                    {{GetNameElement(prj.sectionID, 's')}}
                </td>
                <td>
                    {{GetNameElement(prj.periodID, 'p')}}
                </td>
                <td>
                    {{GetNameElement(prj.rankID, 'r')}}
                </td>
                <td>
                    {{GetNameElement(prj.typeID, 't')}}
                </td>                
                <td>
                    {{prj.effort}}
                </td>                    
            </tr>
            <tr ng-repeat-end ng-if="GetCurrent(prj.saleplanID, prj.projectID)" class="sumCol">
                <td colspan="6"></td>
                <td><b>{{GetSumEffort()}}</b></td>
            </tr>
        </tbody>
    </table>
</div>