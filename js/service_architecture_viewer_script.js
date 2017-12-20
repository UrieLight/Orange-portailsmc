$(document).ready(function () {
	
    var rang_service = $('#nbr_total_service').val();//not at his rigth place
    // console.log('rang: '+rang_service);//test

    // console.log('initialisation nbr de services: '+rang_service);

	var $$ = go.GraphObject.make;  // for conciseness in defining templates, avoid $ due to jQuery


    var diagram_array;// = new Array();
    // console.log('initialisation diagrammes : ');
    init_architectures_diagrams ();

    function init_architectures_diagrams () {
        
        diagram_array = new Array();
        console.log(rang_service);

        for (i = 1; i <= rang_service; i++) {
    
            diagram_array.push($$(go.Diagram, 
                "architecture"+i,  // create a Diagram for the DIV HTML element
                {
                    initialContentAlignment: go.Spot.Center,  // center the content
                    "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom,
                    "undoManager.isEnabled": true  // enable undo & redo
                }
            )); 

            console.log('diagramme init: '+diagram_array[i]);
        }
    }


    //fonction d'affectation de diagrammes aux divs
    /*function add_diagram (diagram) {
         
        diagram 

        return diagram; 
    }*/


    $('body').on('click', 'a[href^="#architecture"]', function() {
        
        rang_service = $('#nbr_total_service').val();
        console.log('rang: '+rang_service);

        // init_architectures_diagrams ();

        // console.log('diagram_array: '+diagram_array);//test

        var this_architectur_div = $(this).parent().parent().parent().siblings('div').children('div #architecture').children('div[id^=architecture]');
        var this_architectur_id = this_architectur_div.attr('id');

        var this_service_rang = this_architectur_div.attr('rang');

        console.log('this_architectur_div: '+this_architectur_div);
        console.log('this_architectur_id: '+this_architectur_id);
        console.log('this_service_rang: '+this_service_rang);//test

        // console.log(this_service_rang);
        // console.log(this_architectur_div);

        // this_architectur_div.empty();

        // Disable diagram modifications, but allow navigation and selection
        console.log('diagram_array: '+diagram_array);
        diagram_array[this_service_rang-1].isReadOnly = true;

        // define a simple Node template
        diagram_array[this_service_rang-1].nodeTemplate =
          $$(go.Node, 
             new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
            "Vertical",

            // { dragComputation: stayInFixedArea },

            $$(go.Picture, 
                { 
                    margin: 2,
                    width: 35, 
                    height: 50
                    //fill: "white" 
                },
                {
                    portId: "",
                    fromLinkable: true, 
                    toLinkable: true//,
                    // cursor: "pointer"
                    //cursor: "url(img/pencil.png) 1 1"
                },
                new go.Binding("source")
            ),
            $$(go.TextBlock,
                { 
                    margin: 5, 
                    editable: true//,
                    // cursor: "pointer",
                },
                new go.Binding("text", "key")
            )
        );

        diagram_array[this_service_rang-1].linkTemplate = 
        $$(go.Link,

            $$(go.Shape)
        );

        //retrieving of the path in the hidden input sibling the architecture div
        var model_file_name = this_architectur_div.parent().children('input').val();

        // console.log('model_file_name: '+model_file_name);//test
        // but use the default Link template, by not setting diagram.linkTemplate

        // The previous initialization is the same as the minimal.html sample.0
        // Here we request JSON-format text data from the server, in this case from a static file.

        // console.log('jQureyGetJson: ');
        // console.log(
            jQuery.getJSON('../../architectures_JSON_files/'+model_file_name, load);
            // );

        function load(jsondata) {
            
            /*for (diag in jsondata) {

                console.log('jsondata_: '+diag);                
            }*/

            // create the model from the data in the JavaScript object parsed from JSON text
            diagram_array[this_service_rang-1].model = new go.GraphLinksModel(jsondata["nodeDataArray"], jsondata["linkDataArray"]);
        }

    });
});