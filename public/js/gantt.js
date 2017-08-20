function editResources(){
    
}
function loadI18n() {
    GanttMaster.messages = {
    "CANNOT_WRITE":                  "CANNOT_WRITE",
    "CHANGE_OUT_OF_SCOPE":"NO_RIGHTS_FOR_UPDATE_PARENTS_OUT_OF_EDITOR_SCOPE",
    "START_IS_MILESTONE":"START_IS_MILESTONE",
    "END_IS_MILESTONE":"END_IS_MILESTONE",
    "TASK_HAS_CONSTRAINTS":"TASK_HAS_CONSTRAINTS",
    "GANTT_ERROR_DEPENDS_ON_OPEN_TASK":"GANTT_ERROR_DEPENDS_ON_OPEN_TASK",
    "GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK":"GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK",
    "TASK_HAS_EXTERNAL_DEPS":"TASK_HAS_EXTERNAL_DEPS",
    "GANTT_ERROR_LOADING_DATA_TASK_REMOVED":"GANTT_ERROR_LOADING_DATA_TASK_REMOVED",
    "ERROR_SETTING_DATES":"ERROR_SETTING_DATES",
    "CIRCULAR_REFERENCE":"CIRCULAR_REFERENCE",
    "CANNOT_DEPENDS_ON_ANCESTORS":"CANNOT_DEPENDS_ON_ANCESTORS",
    "CANNOT_DEPENDS_ON_DESCENDANTS":"CANNOT_DEPENDS_ON_DESCENDANTS",
    "INVALID_DATE_FORMAT":"INVALID_DATE_FORMAT",
    "TASK_MOVE_INCONSISTENT_LEVEL":"TASK_MOVE_INCONSISTENT_LEVEL",

    "GANTT_QUARTER_SHORT":"trim.",
    "GANTT_SEMESTER_SHORT":"sem."
    };
}
function loadFromLocalStorage() {
    var ret;
    if (localStorage) {
    if (localStorage.getObject("teamworkGantDemo")) {
        ret = localStorage.getObject("teamworkGantDemo");
    }
    }

    //if not found create a new example task
    if (!ret || !ret.tasks || ret.tasks.length == 0){
    ret= {"tasks":    [
        {"id": -1, "name": "Gantt editor", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 0, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": 1396994400000, "duration": 20, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
        {"id": -2, "name": "coding", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 1, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": 1396994400000, "duration": 10, "end": 1398203999999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
        {"id": -3, "name": "gantt part", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": 1396994400000, "duration": 2, "end": 1397167199999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
        {"id": -4, "name": "editor part", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "3", "canWrite": true, "start": 1397167200000, "duration": 4, "end": 1397685599999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
        {"id": -5, "name": "testing", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 1, "status": "STATUS_SUSPENDED", "depends": "2:5", "canWrite": true, "start": 1398981600000, "duration": 5, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
        {"id": -6, "name": "test on safari", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "", "canWrite": true, "start": 1398981600000, "duration": 2, "end": 1399327199999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
        {"id": -7, "name": "test on ie", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "6", "canWrite": true, "start": 1399327200000, "duration": 3, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
        {"id": -8, "name": "test on chrome", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "6", "canWrite": true, "start": 1399327200000, "duration": 2, "end": 1399499999999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false}
    ], "selectedRow": 2, "deletedTaskIds": [],
        "resources": [
        {"id": "tmp_1", "name": "Resource 1"},
        {"id": "tmp_2", "name": "Resource 2"},
        {"id": "tmp_3", "name": "Resource 3"},
        {"id": "tmp_4", "name": "Resource 4"}
    ],
        "roles":       [
        {"id": "tmp_1", "name": "Project Manager"},
        {"id": "tmp_2", "name": "Worker"},
        {"id": "tmp_3", "name": "Stakeholder"},
        {"id": "tmp_4", "name": "Customer"}
    ], "canWrite":    true, "canWriteOnParent": true, "zoom": "w3"}


    //actualize data
    var offset=new Date().getTime()-ret.tasks[0].start;
    for (var i=0;i<ret.tasks.length;i++) {
        ret.tasks[i].start = ret.tasks[i].start + offset;
    }
    }
    return ret;
}

$.JST.loadDecorator("RESOURCE_ROW", function(resTr, res){
    resTr.find(".delRes").click(function(){$(this).closest("tr").remove()});
});

$.JST.loadDecorator("ASSIGNMENT_ROW", function(assigTr, taskAssig){
    var resEl = assigTr.find("[name=resourceId]");
    var opt = $("<option>");
    resEl.append(opt);
    for(var i=0; i< taskAssig.task.master.resources.length;i++){
    var res = taskAssig.task.master.resources[i];
    opt = $("<option>");
    opt.val(res.id).html(res.name);
    if(taskAssig.assig.resourceId == res.id)
        opt.attr("selected", "true");
    resEl.append(opt);
    }
    var roleEl = assigTr.find("[name=roleId]");
    for(var i=0; i< taskAssig.task.master.roles.length;i++){
    var role = taskAssig.task.master.roles[i];
    var optr = $("<option>");
    optr.val(role.id).html(role.name);
    if(taskAssig.assig.roleId == role.id)
        optr.attr("selected", "true");
    roleEl.append(optr);
    }

    if(taskAssig.task.master.permissions.canWrite && taskAssig.task.canWrite){
    assigTr.find(".delAssig").click(function(){
        var tr = $(this).closest("[assId]").fadeOut(200, function(){$(this).remove()});
    });
    }

});


function loadI18n(){
    GanttMaster.messages = {
    "CANNOT_WRITE":"No permission to change the following task:",
    "CHANGE_OUT_OF_SCOPE":"Project update not possible as you lack rights for updating a parent project.",
    "START_IS_MILESTONE":"Start date is a milestone.",
    "END_IS_MILESTONE":"End date is a milestone.",
    "TASK_HAS_CONSTRAINTS":"Task has constraints.",
    "GANTT_ERROR_DEPENDS_ON_OPEN_TASK":"Error: there is a dependency on an open task.",
    "GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK":"Error: due to a descendant of a closed task.",
    "TASK_HAS_EXTERNAL_DEPS":"This task has external dependencies.",
    "GANNT_ERROR_LOADING_DATA_TASK_REMOVED":"GANNT_ERROR_LOADING_DATA_TASK_REMOVED",
    "CIRCULAR_REFERENCE":"Circular reference.",
    "CANNOT_DEPENDS_ON_ANCESTORS":"Cannot depend on ancestors.",
    "INVALID_DATE_FORMAT":"The data inserted are invalid for the field format.",
    "GANTT_ERROR_LOADING_DATA_TASK_REMOVED":"An error has occurred while loading the data. A task has been trashed.",
    "CANNOT_CLOSE_TASK_IF_OPEN_ISSUE":"Cannot close a task with open issues",
    "TASK_MOVE_INCONSISTENT_LEVEL":"You cannot exchange tasks of different depth.",
    "GANTT_QUARTER_SHORT":"Quarter",
    "GANTT_SEMESTER_SHORT":"Sem",
    "CANNOT_MOVE_TASK":"CANNOT_MOVE_TASK",
    "PLEASE_SAVE_PROJECT":"PLEASE_SAVE_PROJECT"
    };
}



function createNewResource(el) {
    var row = el.closest("tr[taskid]");
    var name = row.find("[name=resourceId_txt]").val();
    var url = contextPath + "/applications/teamwork/resource/resourceNew.jsp?CM=ADD&name=" + encodeURI(name);

    openBlackPopup(url, 700, 320, function (response) {
    //fillare lo smart combo
    if (response && response.resId && response.resName) {
        //fillare lo smart combo e chiudere l'editor
        row.find("[name=resourceId]").val(response.resId);
        row.find("[name=resourceId_txt]").val(response.resName).focus().blur();
    }

    });
}

function generateMMData(gantt){
    
}
function onSave(){
    var prj = ge.saveProject();
    if(prj.tasks.length>0){
        document.getElementById('title');
        document.getElementById('gantt').value=JSON.stringify(prj);
        document.getElementById('form_save').submit();
    }
}
function onToMM(){
    var prj = ge.saveProject();
    
    if(prj.tasks.length>0){
        var newMind = generateMMData(prj);;
        document.getElementById('title2');
        document.getElementById('ganttData2').value=JSON.stringify(prj);
        //document.getElementById('mindmap2').value=JSON.stringify(newMind);
        document.getElementById('form_toMM').submit();
    }                        
}     
var ge;
$(function() {
    var canWrite=true;
    ge = new GanttMaster();
    var workSpace = $("#workSpace");
    workSpace.css({width:$(window).width(),height:$(window).height()});
    ge.init(workSpace);
    loadI18n(); //overwrite with localized ones
    delete ge.gantt.zoom;
    //var project=loadFromLocalStorage();
    //var project = {!!$project->gantt!!};
    //var project=
    var project=$.parseJSON(document.getElementById('ganttData2').value);
    
    if (!project.canWrite)
        $(".ganttButtonBar button.requireWrite").attr("disabled","true");
    ge.loadProject(project);
    ge.checkpoint(); //empty the undo stack
    ge.editor.element.oneTime(100, "cl", function () {$(this).find("tr.emptyRow:first").click()});
    $(window).resize(function(){
        workSpace.css({width:$(window).width() - 1,height:$(window).height() - workSpace.position().top});
        workSpace.trigger("resize.gantt");
    }).oneTime(150,"resize",function(){$(this).trigger("resize")});
});
