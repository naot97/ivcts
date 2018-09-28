<style type="text/css">
:root {
      --light-border: 2px solid black;
      --second-color: #ffff8c;
    }
    #tblReport thead {
        text-align: center;
        font-weight: bold;
        background-color: #F0E68C;
    }
    #tblReport thead tr th {
        text-align: center;
    }
    #tblReport thead tr .prName{
        border-bottom : var(--light-border) !important;
    }
    #tblReport thead tr .sumInHead{
        text-align: left !important;
        background-color: tomato;
    }
    
    #tblReport .tdblock {
        vertical-align: middle !important;
    }
    #tblReport tbody tr:hover {
        background-color: #DDDDDD ;
    }
    #tblReport tbody tr:hover > .tdblock {
        background-color: #fff;
    }
    .section{
        background-color: #C0C0C0; 
        border-top:var(--light-border); 
    }
    #tblReport tfoot {
        background-color: yellow;
        color: red;
        font-weight: bold;
        border-top: var(--light-border) !important;
    }
    td{
        width: 0.001% !important;
    }
    #table{
        overflow-x: auto;
        margin-top: 5px;
    }
    .borderLeft{
        border-left: var(--light-border) !important;
    }
</style>
<div class="p-t-10">
<h4  class="card-header text-white ">List Report</h4>
<div id="table"  >
    <table  id="tblReport" class="table table-bordered "  cellspacing="0" width="100%" >
        <thead>
            <tr >
               <th  style=" border-bottom:var(--light-border) ; text-align: center;" colspan="{{lstProject.length*4 + 5}}"> {{GetNameElement(periodID,'p')}} </th>
               
            </tr>
            <tr>
                <th rowspan="2" class="tdblock">Employee</th>
                <th class="prName borderLeft" ng-repeat='project in lstProject' colspan="4">{{project.projectName}}</th>
                <th  class="align-middle prName borderLeft">Assign</th>
                <th  class="align-middle prName">Avail</th>     
                <th  class="align-middle prName">Ratio Assign</th>   
                <th  rowspan="2" class="tdblock borderLeft">Employee</th>       
            </tr>
            <tr>
                <th ng-repeat="n in [] | range:lstProject.length*4" style="{{separateProject($index)}}" >
                    {{
                        $index % 4 == 0 ? 'Effort' : $index % 4 == 1 ? 'Rank' : $index % 4 == 2 ?'Type' : 'OT' ;
                    }}
                </th>
                <th class="borderLeft"></th>
                <th class="sumInHead ">{{sumNumAvail}}</th>
                <th class="sumInHead ">{{sumNumFairlyAvail}}</th>

            </tr>
        </thead>
        <tbody >         
            <tr ng-repeat-start="s in lstSection" class="section">
                <td >{{s.sectionName + ' : ' + sectionJson[s.sectionID].list.length}}</td>
                <td class="borderLeft" colspan="4" ng-repeat='i in [] | range:lstProject.length'></td>
                <td class="borderLeft"></td>
                <td style="color: red; "><b>{{sectionJson[s.sectionID].numAvail}}</b></td>
                <td style="color: red;"><b>{{sectionJson[s.sectionID].numFairlyAvail}}</b>
                <td class="borderLeft"></td>
            </tr>
                <tr ng-repeat-start='e in sectionJson[s.sectionID].list' style="border-top:var(--light-border);" >  
                    <td class="tdblock" rowspan="{{spendTimeJson[e.employeeID].maxL}}" >{{e.employeeName}}</td>
    
                    <td ng-repeat='i in [] | range:lstProject.length*4' style="{{getStyle(e.employeeID,$index,0)}}" >
                        {{getValueToColumn(e.employeeID,$index,0) }}
                    </td>
                    <td class="tdblock borderLeft" rowspan="{{spendTimeJson[e.employeeID].maxL}}" style="color: tomato;">
                    {{ sumEffort[e.employeeID].toFixed(2) }}
                     </td>
                    <td class="tdblock" rowspan="{{spendTimeJson[e.employeeID].maxL}}">
                    {{(workingHour - sumEffort[e.employeeID]).toFixed(2)}}
                    </td>
                    <td class="tdblock" rowspan="{{spendTimeJson[e.employeeID].maxL}}" style="color: green">{{sumEffort[e.employeeID]/workingHour}}    </td>
                    <td  rowspan="{{spendTimeJson[e.employeeID].maxL}}" class="borderLeft tdblock" >{{e.employeeName}}</td>
                </tr>
                    <tr ng-if='spendTimeJson[e.employeeID].maxL > 1' ng-repeat='i in [] | range: (spendTimeJson[e.employeeID].maxL - 1)'>
                        <td ng-repeat='i in [] | range:lstProject.length*4' style="{{getStyle(e.employeeID,$index,$parent.$index + 1)}}">
                                {{getValueToColumn(e.employeeID,$index,$parent.$index + 1) }}
                        </td>
                    </tr>
                <tr ng-repeat-end hidden="true">
                </tr>
                
            <tr ng-repeat-end hidden="true"></tr>
        </tbody>
        <tfoot>
            <tr>
            <td> {{sumEmployee}}</td>
            <td ng-if='lstProject.length > 0' colspan="{{lstProject.length * 4}}" ></td>
            <td > {{(sumEffortOfAll / sumEmployee).toFixed(2)}}</td>
            <td > {{( (workingHour * sumEmployee - sumEffortOfAll) / sumEmployee).toFixed(2)}}</td>
            <td colspan="2">{{(sumEffortOfAll / sumEmployee / workingHour).toFixed(2)}}</td>
        </tr>
        </tfoot>
    </table>
</div>
</div>