$(document).ready(function(e) {
    var canvas = document.getElementById('jsmind_container');
    canvas.style.width=window.parent.screen.width+'px';
    canvas.style.height=String($(e.target).height()-canvas.offsetTop-10)+'px';
    load_jsmind();
    

    var header = document.getElementById('header');
    // windowのリサイズ設定
    var id;
    $(window).on('resize', function(e){
        clearTimeout(id);
        id = setTimeout(function(){
            canvas.style.width=String($(e.target).width())+'px';
            canvas.style.height=String($(e.target).height()-canvas.offsetTop-10)+'px';
            _jm.resize();
        }, 100);
    });
    $(window).trigger('resize');
    shortcut.add("Ctrl+s",function() {
        onSave();
    });
    
});

function insertUpdatedTask(mind_data, gantt_task, taskArry){
    var ganttTask = {};
    for(var k in gantt_task){
        ganttTask[k] = gantt_task[k];
    }
    ganttTask.id = mind_data.id;
    ganttTask.name=mind_data.topic;
    taskArry[taskArry.length]=ganttTask;
}
function insertNewTask(mind_data, taskArry){
    var ganttTask = {};
    ganttTask.id = mind_data.id;
    ganttTask.name=mind_data.topic;
    ganttTask.progress=0;
    ganttTask.progressByWorklog=false,
    ganttTask.relevance=0,
    ganttTask.type="",
    ganttTask.typeId="",
    ganttTask.description="",
    ganttTask.level=1,
    ganttTask.status="STATUS_ACTIVE",
    ganttTask.depends="",
    ganttTask.canWrite=true,
    ganttTask.start=1499007600000,
    ganttTask.duration=20,
    ganttTask.end=1501253999999,
    ganttTask.startIsMilestone=false,
    ganttTask.endIsMilestone=false,
    ganttTask.collapsed=false,
    ganttTask.assigs=[],
    ganttTask.hasChild=(mind_data.id=="root");
    taskArry[taskArry.length]=ganttTask;
}
function checkNesting(mind_array, taskArry){
    for(var i=1;i<mind_array.length;i++){
        for(var j=0;j<taskArry.length;j++){
            if(taskArry[j].id==mind_array[i].parentid){
                taskArry[j].hasChild = true;
                taskArry[i].level = taskArry[j].level+1;
                break;
            }
        }
    }
}
function generateGantData(mind_data){
    //formatはそのままコピー
    var taskArry = new Array();
    //var gantt = {!!$project->gantt!!};
    var gantt=$.parseJSON(document.getElementById('ganttData').value);
    
    for(var i=0;i<mind_data.data.length;i++){
        var isExit = false;
        for(var j=0;j<gantt.tasks.length;j++){
            if(mind_data.data[i].id==gantt.tasks[j].id)
            {
                insertUpdatedTask(mind_data.data[i], gantt.tasks[j], taskArry);
                isExit=true;
                break;
            }
        }
        if(!isExit){
            insertNewTask(mind_data.data[i], taskArry);
        }
    }
    taskArry[0].level=0;
    checkNesting(mind_data.data, taskArry);
    var newGantt = {};
    newGantt.tasks = taskArry;
    newGantt.selectedRow = gantt.selectedRow;
    newGantt.resources = gantt.resources;
    newGantt.roles = gantt.roles;
    newGantt.canWrite= gantt.canWrite;
    newGantt.canWriteOnParent = gantt.canWriteOnParent;
    newGantt.zoom = gantt.zoom;
    return newGantt;
    //alert(JSON.stringify(taskArry));
}
function onSave(){
    var mind_data = _jm.get_data('node_array');
    //連打したら空でセーブされる対策
    if(mind_data.data.length>0){
        var newGantt = generateGantData(mind_data);
        var mind_str = JSON.stringify(mind_data);
        var title=mind_data.data[0].topic;                            
        document.getElementById('title').value=title;
        document.getElementById('mindmap').value=mind_str;
        document.getElementById('ganttData').value=JSON.stringify(newGantt);
        document.getElementById('form_save').submit();
    }
}
function onToGantt(){
    var mind_data = _jm.get_data('node_array');
    //連打したら空でセーブされる対策
    if(mind_data.data.length>0){
        var newGantt = generateGantData(mind_data);
        //alert(JSON.stringify(newGantt));
        var mind_str = JSON.stringify(mind_data);
        var title=mind_data.data[0].topic;                            
        document.getElementById('title2').value=title;
        document.getElementById('mindmap2').value=mind_str;
        document.getElementById('ganttData2').value=JSON.stringify(newGantt);
        document.getElementById('form_toGantt').submit();
    }
}
var _jm = null;
function load_jsmind(){
    //var mind = {!!$project->mindmap!!};
    //alert(document.getElementById('mindmap').value);
    var temp = document.getElementById('mindmap').value;
    var mind = (new Function("return " + temp))();
    //var mind=JSON.parse(document.getElementById('mindmap').value);
    //alert(mind);
    var options = {
        container:'jsmind_container',
        editable:true,
        theme:'default',
        MODE : ' Full ',            // display mode 
        support_html :  false ,     // whether to support node in HTML elements 
        View : {
            hmargin : 0 ,         // mind FIG minimum horizontal distance from the outer frame of the container 
            vmargin : 0 ,          // mind container frame from FIG minimum vertical distance 
            line_width : 1 ,        // mind FIG line thickness 
            line_color : ' # 1111FF '    // color mind FIG lines
        },
        layout:{
            hspace : 20 ,           // horizontal spacing between nodes 
            vSpace : 20  ,           // vertical spacing between the nodes 
            PSPACE : 13             // Node contraction / expansion controller size
        },
        shortcut:{
            enable :  true ,         // whether to enable shortcuts 
            Handles : {},          // name of the shortcut key event handler 
            Mapping : {            // shortcuts mapped 
                addChild    :  45 ,     // <Insert> 
                addbrother :  13 ,     // <the Enter> 
                editnode    :  113 ,    // <F2 of> 
                delnode     :  46  ,     // <the Delete> 
                Toggle      :  32 ,     // <Space> 
                left        :  37  ,     // <left> 
                up          :  38  ,     // <up> 
                right       :  39 ,     // <Right> 
                Down        :  40 ,     // <Down>
            }
        },
    }                        
    _jm = jsMind.show(options,mind);
    
}

function onAddChild(){
    var selected_node = _jm.get_selected_node(); // as parent of new node
    if(!selected_node){
        alert('please select a node first.');
        return;
    }
    var nodeid = jsMind.util.uuid.newid();
    var topic = 'New Node';
    var node = _jm.add_node(selected_node, nodeid, topic);
    _jm.select_node(nodeid);
    _jm.begin_edit(nodeid);
}
function onAddBrother(){
    var selected_node = _jm.get_selected_node(); // as parent of new node
    var parent_node= selected_node.parent;
    if(!parent_node){
        alert('please select a node first.');
        return;
    }
    var nodeid = jsMind.util.uuid.newid();
    var topic = 'New Node';
    var node = _jm.add_node(parent_node, nodeid, topic);
    _jm.select_node(nodeid);
    _jm.begin_edit(nodeid);
}
function onDeleteNode(){
     var selected = _jm.get_selected_node();
    if(!selected){
        alert('please select a node first.');
        return;
    }
    if(!selected.isroot){
        _jm.remove_node(selected);
    }
}
var zoomInButton = document.getElementById("zoom-in-button");
var zoomOutButton = document.getElementById("zoom-out-button");
function onZoomIn() {
    if (_jm.view.zoomIn()) {
        zoomOutButton.disabled = false;
    } else {
        zoomInButton.disabled = true;
    };
};
function onZoomOut() {
    if (_jm.view.zoomOut()) {
        zoomInButton.disabled = false;
    } else {
        zoomOutButton.disabled = true;
    };
};
function change_text_font(){
    var selected_id = get_selected_nodeid();
    if(!selected_id){prompt_info('please select a node first.');return;}

    _jm.set_node_font_style(selected_id, 28);
}

function change_text_color(){
    var selected_id = get_selected_nodeid();
    if(!selected_id){prompt_info('please select a node first.');return;}

    _jm.set_node_color(selected_id, null, '#000');
}

function change_background_color(){
    var selected_id = get_selected_nodeid();
    if(!selected_id){prompt_info('please select a node first.');return;}

    _jm.set_node_color(selected_id, '#eee', null);
}


