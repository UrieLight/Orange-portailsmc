/*
*	Script pour l'update des architectures
*/

$(document).ready(function() {
	
		//désactivation du bouton de modification lorsqu'aucune modification n'a lieu
		/*$('#bouton_confirmtn_modification_architecture').prop('disabled', true).css({
			cursor: 'not-allowed'
		});*/

		



	    /*================= Initialisation du graph avec l'architecture sélectionée =================*/

	    	var architecture_selected_id;
	    	var architecture_selected_name;
			var architecture_selected_desc;
			var architecture_selected_file;

			//retrieving on change de l'id de l'architecture selected
			$('select[name="list_of_architectures_to_update"]').on('change', function() {
				// event.preventDefault();
				/* Act on the event */
				var architecture_selected = $(this).val();
				// console.log('plateforme: '+plateforme_selected);
				//going through all the options to find the one having the 
				//same value than the value of the select tag
				$(this).children().each(function() {
					
					// console.log($(this).attr('value'));
					// if ($(this).attr('value') == architecture_selected) {
					if ($(this).val() == architecture_selected) {

						architecture_selected_id = $(this).attr('id');
						architecture_selected_name = $(this).attr('name');
						architecture_selected_desc = $(this).attr('architecture_desc');
						architecture_selected_file = $(this).attr('architecture_jsonfile');
						// console.log($(this).attr('id_chainsout'));
						// chaine_sout_display(id_chaineselected);

						//remplissage des champs de textes avec les donnees deja en bases, pour etre modifiees
						$('#architecture_name').val($(this).val());
						$('#architecture_description').val($(this).attr('architecture_desc'));
					}
				});

		        jQuery.getJSON('../../architectures_JSON_files/'+architecture_selected_file, load);

		        function load(jsondata) {

		            // create the model from the data in the JavaScript object parsed from JSON text
		            myDiagram.model = new go.GraphLinksModel(jsondata["nodeDataArray"], jsondata["linkDataArray"]);
		            // loadDiagramProperties();
		        }
			});



	    /*================= Initialisation du graph =================*/

	    	/* if (window.goSamples) 
	    	goSamples();*/  // init for these samples -- you don't need to call this

	    	var $$ = go.GraphObject.make;  // for conciseness in defining templates

		    myDiagram =
	      	$$(go.Diagram, "workplace",  // must name or refer to the DIV HTML element
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
	        });

	    // console.log('diagramme init: '+myDiagram);

	    var diagramVide = true; //variable stockant l'etat du diagrame

      	/*================= Gestion des modifications et sauvegarde du graph =================*/
		    // when the document is modified, add a "*" to the title and enable the "Save" button
		    myDiagram.addDiagramListener("Modified", function(e) {

		        var button = document.getElementById("SaveButton");

		        if (button) 
		        	button.disabled = !myDiagram.isModified;

		        var idx = document.title.indexOf("*");


		        if (myDiagram.isModified) {

		        	// console.log('diagram modified');

		        	//verification de la taille de l'array des noeuds dans le diagramme, pour ne pas sauvegarder du vide
		        	if((myDiagram.model.nodeDataArray).length > 0) {

	          			diagramVide = false;
	          			// console.log('diagrame non vide');

	          			if ($('#architecture_name').val() == "") {

	          				// console.log('nom architecture vide');
	          				deactivate_the_confirm_button();
	          			}
	          			else{
	          				// console.log('nom architecture non vide');
	          				activate_the_confirm_button();
	          			}
	          		}else {
	          			// console.log('diagrame vide');
	          			diagramVide = true;
	          			deactivate_the_confirm_button();
	          		}
	          		//fin verification

		          	if (idx < 0){

		          		document.title += "*";
		          	} 
		        }else{
		          	if (idx >= 0)

		          		document.title = document.title.substr(0, idx);
		        }


		    });

		/*================= activation ou desactivation du Bonton d'enregistrement de l'architecture  =================*/

			//activation suivant les événements clés
			$('#architecture_name').on('keyup', function() {
				
				//si après la dernière touche clavier enfoncée, le nom est vide, on désactive le bouton, 
				//car un service doit avoir un nom
				if ($('#architecture_name').val() == "") {

					// console.log('champ nom architecture vide');
					deactivate_the_confirm_button ();
				}else if(diagramVide){

					// console.log('champ nom architecture ok, mais diagrame vide');
					deactivate_the_confirm_button ();
				}else {

					// console.log("All ok");
					activate_the_confirm_button();
				}
			});


			$('#bouton_confirmtn_modification_architecture').on('click', function() {
				// event.preventDefault();
				/* Act on the event */
				/*if ($('#architecture_name').val() == "") {

					alert('Entrez un nom pour cette architecture.');
				}
				if (diagramVide) {
					alert('Dessinez une architecture.');
				}*/

				/*console.log($(this));
				console.log($('select').val());*/
			});


			//fonction d'activation du boutton de sauvegarde de l'architecture
			function activate_the_confirm_button () {
				
				$('#bouton_confirmtn_modification_architecture').prop('disabled', false).css({
					cursor: 'default'
				});
			}


			//fonction d'activation du boutton de sauvegarde de l'architecture
			function deactivate_the_confirm_button () {
				
				$('#bouton_confirmtn_modification_architecture').prop('disabled', true).css({
					cursor: 'not-allowed'
				});
			}


	    /*================= Bontons de link des objects =================*/

	    // Define a function for creating a "port" that is normally transparent.
	    // The "name" is used as the GraphObject.portId, the "spot" is used to control how links connect
	    // and where the port is positioned on the node, and the boolean "output" and "input" arguments
	    // control whether the user can draw links from or to the port.

	    function makePort(name, spot, output, input) {
	      	// the port is basically just a small transparent square
	      	return $$(go.Shape, "Circle",
	            {
	                fill: null,  // not seen, by default; set to a translucent gray by showSmallPorts, defined below
	                stroke: null,
	                desiredSize: new go.Size(7, 7),
	                alignment: spot,  // align the port on the main Shape
	                alignmentFocus: spot,  // just inside the Shape
	                portId: name,  // declare this object to be a "port"
	                fromSpot: spot, toSpot: spot,  // declare where links may connect at this port
	                fromLinkable: output, toLinkable: input,  // declare whether the user may draw links to/from here
	                cursor: "pointer"  // show a different cursor to indicate potential link point
	            });
	    }

	    	/*var cxElement = document.getElementById("contextMenu");

			var myContextMenu = $(go.HTMLInfo, {
			    show: showContextMenu,
			    mainElement: cxElement
			});*/

	    myDiagram.nodeTemplate =
	    $$(go.Node, "Spot",
	        { 
	        	locationSpot: go.Spot.Center 
	        },
	        
	        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
	        { selectable: true },

		    { rotatable: true},
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
	        ),
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
	        }
	    );

	    myDiagram.nodeTemplateMap.add("ImageNode",
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
				          	// background: "white",
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
			    makePort("T", go.Spot.Top, true, true),
			    makePort("L", go.Spot.Left, true, true),
			    makePort("R", go.Spot.Right, true, true),
			    makePort("B", go.Spot.Bottom, true, true),
				{ // handle mouse enter/leave events to show/hide the ports
				    mouseEnter: function(e, node) { showSmallPorts(node, true); },
				    mouseLeave: function(e, node) { showSmallPorts(node, false); }
			    }
		  	)
		);

	    function showSmallPorts(node, show) {
	      	node.ports.each(function(port) {
	      	  	if (port.portId !== "") {  // don't change the default port, which is the big shape
	      	  	  	port.fill = show ? "rgba(0,0,0,.3)" : null;
	      	  	}
	      	});
	    }

	    myDiagram.linkTemplate =
      	$$(go.Link,  // the whole link panel
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

	    //load();  // load an initial diagram from some JSON text



	    /*================= Objets Palette shapes =================*/

		    var link = myDiagram.links.first();
		    if (link) 
		    	link.isSelected = true;



      	/*================= Objets Palette imgs =================*/
      	

      		var root_path = "../../img/eqpmt/";

		    // initialize the Palette that is on the left side of the page
		     myPalette =
	      	$$(go.Palette, "custom_palette",  // must name or refer to the DIV HTML element
		        {
		          	maxSelectionCount: 1,
		          	nodeTemplateMap: myDiagram.nodeTemplateMap,  // share the templates used by myDiagram
		          	model: new go.GraphLinksModel([  // specify the contents of the Palette
		          	  	{
	        				source: root_path+"serveur.png",/*,
	        				width: 45, 
	    	  				height: 61,*/ 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"bridge.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"serveur_de_bd.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"ordinateur_central_bd.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"serveur_fichier.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"phone.png",
	        				/*width: 20, 
	    	  				height: 25, */
	    	  				margin: 2,
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"pc.png",
	        				/*width: 20, 
	    	  				height: 25, */
	    	  				margin: 2,
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"firewall.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"bts.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"ordinateur_central.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"server_firewall.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"serveur_application.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"serveur_donnees.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"eqpmt_1.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"eqpmt_2.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"eqpmt_3.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"switch.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"router.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"router_2.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"server_2.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"eqpmt_6.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{ 
		          	  		text: "", 
		          	  		figure: "Triangle", 
		          	  		fill: "green",
		          	  		width: 15, 
    	  					height: 10
		          	  	},
		          	  	{ 
		          	  		text: "Text"
		          	  	},
		          	  	{ 
		          	  		text: "Database", 
		          	  		figure: "Database", 
		          	  		fill: "lightgray" 
		          	  	},
		          	  	{ 
		          	  		text: "Internet", 
		          	  		figure: "Cloud", 
		          	  		fill: "lightskyblue" 
		          	  	},
		          	  	{ 
		          	  		text: "Text", 
		          	  		figure: "Circle", 
		          	  		fill: "red"/*,
		          	  		width: 3, 
    	  					height: 3,*/
		          	  	},
		          	  	{ 
		          	  		text: "Block 1", 
		          	  		figure: "RoundedRectangle", 
		          	  		fill: "lightyellow" 
		          	  	},
		          	  	{ 
		          	  		text: "Block 2", 
		          	  		figure: "RoundedRectangle", 
		          	  		fill: "lightblue" 
		          	  	},
		          	  	{ 
		          	  		text: "Block 3", 
		          	  		figure: "RoundedRectangle", 
		          	  		fill: "pink" 
		          	  	},
		          	  	{ 
		          	  		text: "Block 4", 
		          	  		figure: "RoundedRectangle", 
		          	  		fill: "orange"
		          	  	},
		          	  	{ 
		          	  		text: "Block 5", 
		          	  		figure: "RoundedRectangle", 
		          	  		fill:  "lightgreen"
		          	  	},
		          	  	{ 
		          	  		text: "Block 6", 
		          	  		figure: "RoundedRectangle", 
		          	  		fill: "yellow" 
		          	  	},
		          	  	{ 
		          	  		text: "Block 7", 
		          	  		figure: "RoundedRectangle", 
		          	  		fill: "red" 
		          	  	},
		          	  	{ 
		          	  		text: "Block 8", 
		          	  		figure: "RoundedRectangle", 
		          	  		fill: "blue" 
		          	  	},
		          	  	{ 
		          	  		text: "Block 9", 
		          	  		figure: "RoundedRectangle", 
		          	  		fill:  "green"
		          	  	},
		          	  	{
	        				source: root_path+"nuage_noir.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"Building.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"satellite.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{
	        				source: root_path+"fh.png",
	        				width: 45, 
	    	  				height: 61, 
	        				category: "ImageNode"
	        				// margin: 5
	        			},
		          	  	{ 
		          	  		source: root_path+"arrow_up.png",/*,
	        				width: 45, 
	    	  				height: 61,*/ 
	        				category: "ImageNode"
		          	  	},
		          	  	{ 
		          	  		source: root_path+"arrow.png",/*,
	        				width: 45, 
	    	  				height: 61,*/ 
	        				category: "ImageNode"
		          	  	},
		          	  	{ 
		          	  		source: root_path+"arrow_left.png",/*,
	        				width: 45, 
	    	  				height: 61,*/ 
	        				category: "ImageNode"
		          	  	},
		          	  	{ 
		          	  		source: root_path+"arrow_down.png",/*,
	        				width: 45, 
	    	  				height: 61,*/ 
	        				category: "ImageNode"
		          	  	}
		          	])
		        }
	        );

	  	$('#save').on('click', function() {
	  		// event.preventDefault();
	  		/* Act on the event */
	  		save();
	  	});

	  	function save() {

	        var updated_model_json = myDiagram.model.toJson();
	        // console.log('json architecture: '+updated_model_json);
	        var $site_url = $('#site_url').attr('class');
	        var updated_architecture_name = $('#architecture_name').val();
	        var updated_architecture_desc = $('#architecture_description').val();
	        // var updated_architecture_jsonfile = $('#architecture_description').val();//ATTENTION


	        // console.log('model json: '+updated_model_json);
	        var today_date = new Date();
	        // console.log('Cree le '+);
	        var architecture_update_date = today_date.getFullYear()+'-'+digit_format(today_date.getMonth()+1)+'-'+digit_format(today_date.getDate());
	        var updated_architecture_author = $('#username').text();

	        //console.log("date: "+architecture_update_date)

	        //##architectur creation module extended
	        $.ajax({
	                url: $site_url+'/Architectures/architectures_update_saving',
	                method: "POST",
	                data: {
	                    updated_model_json: updated_model_json,
	                    updated_architecture_id: architecture_selected_id,
	                    updated_architecture_name: updated_architecture_name,
	                    updated_architecture_desc: updated_architecture_desc,
	                    // updated_architecture_jsonfile: updated_architecture_jsonfile,
	                    updated_architecture_author: updated_architecture_author,
	                    architecture_update_date: architecture_update_date
	                },
	                success:function (data) {

	                    console.log(data);
	                    /*$('#architecture_name').val('');
	                    $('#architecture_description').val('');*/
	                    alert('Architecture modifiée avec succès !!');
	                    location.reload(true);
	                },
	                error: function() {
	                    alert('Echec de la mise à jour de l\'Architecture !!');
	                }
	        });
	    }

	    //ajout d'un zero devant les chiffres inf to 10
	    function digit_format(digit) {
	    	// body...
	    	var formated_digit = 0;

	    	if (digit<=9) {
	    		formated_digit = '0'+digit;
	    		return formated_digit;
	    	}else {
	    		return digit;
	    	}
	    }

	
	  	// Called by "InitialLayoutCompleted" DiagramEvent listener, NOT directly by load()!
	  	function loadDiagramProperties(e) {
	  	  	// set Diagram.initialPosition, not Diagram.position, to handle initialization side-effects
	  	  	var pos = myDiagram.model.modelData.position;
	  	  	if (pos) myDiagram.initialPosition = go.Point.parse(pos);
	  	}

});