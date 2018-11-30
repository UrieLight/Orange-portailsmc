/*
*To do
*- Inclure la date du blob dans le nom
*
*/
$(document).ready(function () {
	
    var nbr_total_architectures = $('#nbr_total_architectures').text();//not at his rigth place
    // console.log('rang: '+nbr_total_architectures);//test

    // console.log('initialisation nbr de architectures: '+nbr_total_architectures);

	var $$ = go.GraphObject.make;  // for conciseness in defining templates, avoid $ due to jQuery


    var diagram_array;// = new Array();
    // console.log('initialisation diagrammes : ');
    init_architectures_diagrams ();
        
    var diagram_array2 = new Array();//not working when i put it here, out of the init function. the on cllick listener is not working.

    function init_architectures_diagrams () {
        // console.log('count to '+nbr_total_architectures);

        diagram_array = new Array();

        for (i = 1; i <= nbr_total_architectures; i++) {
    
            myDiagram = 
                $$(go.Diagram, 'architecture'+i,  // create a Diagram for the DIV HTML element
                {
                    // supply a simple narrow grid that manually reshaped link routes will follow
                    grid: $$(go.Panel, "Grid",
                                { 
                                    gridCellSize: new go.Size(8, 8) 
                                },
                                $$(go.Shape, "LineH", { stroke: "lightgray", strokeWidth: 0.5 }),
                                $$(go.Shape, "LineV", { stroke: "lightgray", strokeWidth: 0.5 })
                            ),
                    allowDrop: true,  // must be true to accept drops from the Palette
                    "draggingTool.isGridSnapEnabled": true,
                    linkReshapingTool: $$(SnapLinkReshapingTool),
                    rotatingTool: new RotateMultipleTool(),
                    // when the user reshapes a Link, change its Link.routing from AvoidsNodes to Orthogonal,
                    // so that combined with Link.adjusting == End the link will retain its reshaped mid points
                    // even after nodes are moved
                    "LinkReshaped": function(e) { 
                        e.subject.routing = go.Link.Orthogonal; 
                    },
                    "animationManager.isEnabled": false,
                    "undoManager.isEnabled": true
                }
            ); 

            // console.log('myDiagram init '+i+': '+myDiagram);
            diagram_array.push(myDiagram);
        }
    }

    diagram_array2 = diagram_array;
    // console.log('diagramme init ['+2+']: '+diagram_array[2]);



    //fonction d'affectation de diagrammes aux divs
    /*function add_diagram (diagram) {
         
        diagram 

        return diagram; 
    }*/


    // $('.architecture_img, .architecture_name').on('click', function() {
    $('.architecture_name').on('click', function() {
        
        // console.log($(this));

        var diagram_div = $(this).parent().parent().siblings('div .service_info').children().children().children('.diagramme');//attr('rang');//div du diagram
        var rang_architecture = diagram_div.attr('rang');//$('#rang_architectures').val();
        // console.log('rang architecture actuelle: '+rang_architecture);

        // init_architectures_diagrams ();

        // console.log('diagram_array: '+diagram_array);//test

        // var this_architectur_div = $(this).parent().parent().parent().siblings('div').children('div #architecture').children('div[id^=architecture]');
        var this_architectur_id = diagram_div.attr('id');

        var this_architecture_rang = rang_architecture;
        // var this_architecture_rang = this_architectur_div.attr('rang');

        console.log('this_architectur_div: '+diagram_div);
        // console.log('this_architectur_id: '+this_architectur_id);
        // console.log('this_architecture_rang: '+this_architecture_rang);//test

        // console.log(this_architecture_rang);
        // console.log(this_architectur_div);

        // this_architectur_div.empty();

        // Disable diagram modifications, but allow navigation and selection
        // console.log('diagram_array: '+diagram_array);

        diagram_array[this_architecture_rang-1].isReadOnly = true;

        // define a simple Node template
        diagram_array[this_architecture_rang-1].nodeTemplate =
            $$(go.Node, 
                new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                "Vertical",

                { 
                    locationSpot: go.Spot.Center 
                },
                
                new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                { 
                    selectable: true 
                },
                { 
                    resizable: true, 
                    resizeObjectName: "PANEL" 
                },
                // { contextMenu: myContextMenu },
                // the main object is a Panel that surrounds a TextBlock with a Shape
                $$(go.Panel, "Auto",
                    { 
                        name: "PANEL" 
                    },
                    new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
                    $$(go.Shape, "Rectangle",  // default figure
                        {
                            portId: "", // the default port: if no spot on link data, use closest side
                            fromLinkable: true, 
                            toLinkable: true, 
                            cursor: "pointer",
                            fill: "white"  // default color
                        },
                        new go.Binding("figure"),
                        new go.Binding("fill")),
                    $$(go.TextBlock,
                        {
                            font: "bold 12px Helvetica, Arial, sans-serif",
                            margin: 8,
                            maxSize: new go.Size(160, NaN),
                            wrap: go.TextBlock.WrapFit,
                            editable: true
                        },
                        new go.Binding("text").makeTwoWay()) 
                // ),
                )/*,
                // four small named ports, one on each side:
                makePort("T", go.Spot.Top, false, true),
                makePort("L", go.Spot.Left, true, true),
                makePort("R", go.Spot.Right, true, true),
                makePort("B", go.Spot.Bottom, true, false),
                { // handle mouse enter/leave events to show/hide the ports
                    mouseEnter: function(e, node) { 
                        showSmallPorts(node, true); 
                    },
                    mouseLeave: function(e, node) { 
                        showSmallPorts(node, false); 
                    }
                }*/
                // )
            );

        diagram_array[this_architecture_rang-1].nodeTemplateMap.add("ImageNode",
            $$(go.Node, "Spot",
                { locationSpot: go.Spot.Center },
                new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                { selectable: true },
                // { draggable: true },
                { resizable: true, resizeObjectName: "PANEL" },
                { rotatable: true},
                // the main object is a Panel that contains a Picture
                $$(go.Panel, "Auto",
                    { name: "PANEL", desiredSize: new go.Size(50, 65) },
                    new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
                    /*$$(go.Shape, "Rectangle",  // default figure
                        {
                          portId: "", // the default port: if no spot on link data, use closest side
                          fromLinkable: true, toLinkable: true, cursor: "pointer",
                          fill: "white"  // default color
                        }
                    ),*/
                    $$(go.Picture,
                        {
                            portId: "", // the default port: if no spot on link data, use closest side
                            fromLinkable: true, toLinkable: true, cursor: "pointer",
                            background: "white",
                            stretch: go.GraphObject.Fill,
                            margin: 8/*,
                            width: 40, 
                            height: 55,*/
                            // draggable: true 
                        },
                        new go.Binding("source")

                        ),
                        $$(go.TextBlock,//add just to be able to drag the image dropped in the diagrame
                        {
                            font: "bold 18px Helvetica, Arial, sans-serif",
                            margin: 12,
                            maxSize: new go.Size(160, 160),
                            wrap: go.TextBlock.WrapFit,
                            editable: false,
                            cursor: "default"
                        },
                        new go.Binding("text").makeTwoWay())
                ),
                // four small named ports, one on each side:
                /*makePort("T", go.Spot.Top, true, true),
                makePort("L", go.Spot.Left, true, true),
                makePort("R", go.Spot.Right, true, true),
                makePort("B", go.Spot.Bottom, true, true),
                { // handle mouse enter/leave events to show/hide the ports
                    mouseEnter: function(e, node) { showSmallPorts(node, true); },
                    mouseLeave: function(e, node) { showSmallPorts(node, false); }
                }*/
            )
        );

        diagram_array[this_architecture_rang-1].linkTemplate = 
            $$(go.Link,

                { 
                    relinkableFrom: true, 
                    relinkableTo: true, 
                    reshapable: true, 
                    resegmentable: true 
                },
                {
                    routing: go.Link.Normal,  // but this is changed to go.Link.Orthgonal when the Link is reshaped
                    adjusting: go.Link.End,
                    curve: go.Link.JumpOver,
                    corner: 5,
                    toShortLength: 4
                },
                new go.Binding("points").makeTwoWay(),
                // remember the Link.routing too
                new go.Binding("routing", 
                               "routing", 
                               go.Binding.parseEnum(go.Link, go.Link.AvoidsNodes))//.None))
                              .makeTwoWay(go.Binding.toString),
                $$(go.Shape,  // the link path shape
                    { 
                        isPanelMain: true, 
                        strokeWidth: 2 
                    })
            );

        

        //retrieving of the path in the hidden input sibling the architecture div
        var model_file_name = diagram_div.siblings('input').val();

        // console.log('model_file_name: '+model_file_name);//test
        // but use the default Link template, by not setting diagram.linkTemplate

        // The previous initialization is the same as the minimal.html sample.0
        // Here we request JSON-format text data from the server, in this case from a static file.

        // console.log('jQureyGetJson: ');
        // console.log(
            jQuery.getJSON('../../architectures_JSON_files/'+model_file_name, load);
            // );

        function load(jsondata) {

            // create the model from the data in the JavaScript object parsed from JSON text
            diagram_array[this_architecture_rang-1].model = new go.GraphLinksModel(jsondata["nodeDataArray"], jsondata["linkDataArray"]);
            loadDiagramProperties();
        }
    

        // Called by "InitialLayoutCompleted" DiagramEvent listener, NOT directly by load()!
        function loadDiagramProperties(e) {
            // set Diagram.initialPosition, not Diagram.position, to handle initialization side-effects
            var pos = diagram_array[this_architecture_rang-1].model.modelData.position;
            if (pos) diagram_array[this_architecture_rang-1].initialPosition = go.Point.parse(pos);
        }



        /*================= boutton de génération de l'image  =================*/ 


            /*$('span[id^=download_button]').on('click', function() {
                    // event.preventDefault();
                    //Act on the event 
                    console.log('boutton: '+$(this).text());
                    makeBlob();

            });*/

            var clickedButtonId = '';
            $('span[id^=download_button]').on('click', function() {
                    // event.preventDefault();
                    /* Act on the event */
                    clickedButtonId = $(this).attr('id');
                    console.log('boutton: '+clickedButtonId);//$(this).text());
                    makeBlob();
            });

    



    
        /*================= functions de génération de l'image  =================*/   

            function myCallback(blob) {

                var url = window.URL.createObjectURL(blob);
                var filename = "model_file_name.png";

                var a = document.createElement("a");
                a.style = "display: none";
                a.href = url;
                a.download = filename;

                // IE 11
                /*if (window.navigator.msSaveBlob !== undefined) {
                    window.navigator.msSaveBlob(blob, filename);
                    return;
                }*/

                document.body.appendChild(a);
                requestAnimationFrame(function() {
                    a.click();
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                });
            }

            function makeBlob() {

                var blob = diagram_array[this_architecture_rang-1].makeImageData( { background: "white", returnType: "blob", callback: myCallback });

                console.log('diagram_array: '+diagram_array[this_architecture_rang-1]);
                // console.log("blob: "+blob);
                //myCallback(blob);
            }

    });



    /*================= GESTION DES ACTIONS SUR LES NOMS DES ARCHITECTURES AVEC LES ONGLETS =================*/

        //affichage des infos d'un service
        $('body').on('click','.architecture_name, .architecture_img img', function () {

            //div service_head parente du lien cliqué
            var $architecture = $(this).parent().parent().parent();//Bloc d'un service dans le catalogue
            var $contenu = $architecture.children('.service_info').children('.navs_content');//informations de chaque onglet

            $architecture.children('.service_info').toggle(function () {
                //lorsque le contenu informatif s'affiche
                //recuperation de l'ancre du lien actif
                var tab_id = $architecture.children('.service_info').children().children('.onglets_info').children('.active').children().attr('href');   
                $contenu.children(tab_id).show(500);    
            });
        });


        //scroll de la page vers le haut
        $(window).scroll(function(){ 
            if ($(this).scrollTop() > 100) { 
                $('#scroll').fadeIn(); 
            } else { 
                $('#scroll').fadeOut(); 
            } 
        }); 
        
        $('#scroll').click(function(){ 
            $("html, body").animate({ scrollTop: 0 }, 600); 
            return false; 
        }); 
});