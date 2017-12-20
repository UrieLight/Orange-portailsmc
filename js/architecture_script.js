$(document).ready(function () {

	var $$ = go.GraphObject.make;

	var diagram = $$(go.Diagram, "workplace",
			{
				initialContentAlignment: go.Spot.Center,
                "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom,
				// "linkingTool.direction": go.LinkingTool.ForwardsOnly,
                allowDrop: true,
                // allowVerticalScroll: false,
				"undoManager.isEnabled": true
			} 
	);

	// initialize the main Diagram
  	
    diagram.nodeTemplate = $$(go.Node, 
        

        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
        "Vertical",

        { dragComputation: stayInFixedArea },

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
        /*$$(go.Panel, "Table",
            {column: 1},*/
            $$(go.TextBlock,
                { 
                    cursor: "pointer",
                    margin: 5, 
                    editable: true//,
                    // cursor: "pointer",pi
                },
                new go.Binding("text", "key")
            )//,
        /*
            { minSize: new go.Size(60, 20), resizable: true },
            // new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
            new go.Binding("position", "pos", go.Point.parse).makeTwoWay(go.Point.stringify),
            // temporarily put selected nodes in Foreground layer
            new go.Binding("layerName", "isSelected", function(s) { return s ? "Foreground" : ""; }).ofObject()//,
        */
           // $$(go.Shape, "Rectangle",
                  //new go.Binding("fill", "color"))
           
            /*,

            $$("PanelExpanderButton", "btn",
                {column: 1}
            ),

            $$(go.Panel, "Vertical",
                {name: "btn", row: 1, column: 1, columnSpan: 2},
                new go.Binding("itemArray", "listpltf")
            )                
        )*/
        
   	);

    //Tooltip
    /*diagram.toolTip =
        $$(go.Adornment, "Auto",
            $$(go.Shape, 
                { fill: "#CCFFCC" }
            ),
            $$(go.TextBlock, 
                { margin: 4 },
                // use a converter to display information about the diagram model
                new go.Binding("text", "name", diagramInfo)
            )
        );*/


    // Define the behavior for the Diagram background:

    function diagramInfo(model) {  // Tooltip info for the diagram's model
        return "Model:\n" + model.nodeDataArray.length + " nodes, " + model.linkDataArray.length + " links";
    }

    //link template, gestion de l'affichage des liens
    diagram.linkTemplate = 
    $$(go.Link,
        /*{ 
            routing: go.Link.Orthogonal,  // may be either Orthogonal or AvoidsNodes
            curve: go.Link.JumpOver 
        },*/
        $$(go.Shape)
    );

    // start off with no Parts
    // diagram.undoManager.isEnabled = true;
    
    // create the Palette
    var myPalette = $$(go.Palette, "full_palette");
    
    // the Palette's node template is different from the main Diagram's
  	myPalette.nodeTemplate = $$(go.Node, "Horizontal",

        // { dragComputation: stayInFixedArea },
        
    	$$(go.Picture,
    	  	{ 	
    	  		margin: (2,3),
    	  		width: 30, 
    	  		height: 45,
                cursor: "pointer" 
    	  		//fill: "white" 
    	  	},
    	  	new go.Binding("source")
    	 ),
    	$$(go.TextBlock,
    		{
    			//textAlign: "center",
                cursor: "pointer",
    			stroke: "black",
    	  		isMultiline: true,
    			font: "12px helvetica",
    			row: 0, column: 5, columnSpan: 5,
    			wrap: go.TextBlock.WrapFitd 
    		},
    	  	new go.Binding("text", "name")
    	)
    );
    //myPalette.nodeTemplate.
  	// the list of data to show in the Palette
    /*var data = $('#data_array').text();
    daata = JSON.parse(data);*/
    var root_path = "../../";


    //récupération des plate-formes (noms d'abord pour essaie, après j'vais aussi prendre les images, soit les chemins soit 
    //la catégorie, puisque plusieurs équipements peuvent avoir la même image)
  	myPalette.model.nodeDataArray = 
    /*[
        { 
            key: "serv.",
            name: "serveur",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur.png" 
        },
        { 
            key: "Serv-app-mob.",
            name: "serveur appli mobile",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_app_mobiles.png" 
        },
        { 
            key: "Serv-msg.",
            name: "Serveur de messagerie",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_mail.png"
        },
        { 
            key: "Ord-cent.",
            name: "Ordinateur central",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/ordinateur_central.png"
        },
        { 
            key: "serv-app.",
            name: "serveur applications",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_application.png" 
        },
        { 
            key: "serv-bd.",
            name: "serveur de bases de donnees",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_de_bd.png" 
        },
        { 
            key: "serv-data.",
            name: "serveur de donnees",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_donnees.png" 
        },
        { 
            key: "internet.",
            name: "nuage",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/nuage.png" 
        },
        { 
            key: "desk.",
            name: "desktop",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/desktop.png" 
        },
        { 
            key: "serv-files.",
            name: "serveur de fichiers",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_fichier.png" 
        },
        { 
            key: "serv-encrypted.",
            name: "serveur applications",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/encrypted_server.png" 
        },
        { 
            key: "bts.",
            name: "BTS",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/bts.png" 
        },
        { 
            key: "certificat server.",
            name: "serveur de certificats",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/certificat_server.png" 
        },
        { 
            key: "phone.",
            name: "phone",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/phone.png" 
        },
        { 
            key: "firewall.",
            name: "firewall",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/firewall.png" 
        },
        { 
            key: "serv-firewall.",
            name: "server firewall",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/server_firewall.png" 
        }
    ];*/
  	[
        { 
            key: "serv.",
            name: "serveur",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur.png" 
        },
        { 
            key: "USSD",
            name: "USSD",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur.png" 
        },
        { 
            key: "SMSC",
            name: "SMSC",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur.png" 
        },
        { 
            key: "Serv-app-mob.",
            name: "serveur appli mobile",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_app_mobiles.png" 
        },
        { 
            key: "Serv-msg.",
            name: "Serveur de messagerie",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_mail.png"
        },
        { 
            key: "IN",
            name: "IN",//ord central
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/ordinateur_central.png"
        },
        { 
            key: "ZEBRA",
            name: "ZEBRA",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_application.png" 
        },
        { 
            key: "DWH",
            name: "DWH",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_de_bd.png" 
        },
        { 
            key: "Broker",
            name: "Broker",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_donnees.png" 
        },
        { 
            key: "Internet.",
            name: "Internet",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/nuage.png" 
        },
        { 
            key: "PC",
            name: "PC",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/desktop.png" 
        },
        { 
            key: "serv-files.",
            name: "serveur de fichiers",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/serveur_fichier.png" 
        },
        { 
            key: "serv-encrypted.",
            name: "serveur applications",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/encrypted_server.png" 
        },
        { 
            key: "bts.",
            name: "BTS",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/bts.png" 
        },
        { 
            key: "OM_GW",
            name: "OM_GW",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/certificat_server.png" 
        },
        { 
            key: "phone.",
            name: "phone",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/phone.png" 
        },
        { 
            key: "Pare_feu.",
            name: "Pare feu",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/firewall.png" 
        },
        { 
            key: "Firewall.",
            name: "Firewall",
            // listpltf: ["USSD", "ZEBRA", "IN"],
            source: root_path+"img/eqpmt/server_firewall.png" 
        }
  	];

    /*
    //mouse dragcreating

    diagram.toolManager.mouseMoveTools.insertAt(
        2,
        $$(DragCreatingTool,
            {
                isEnabled: true,  // disabled by the checkbox
                delay: 0,  // always canStart(), so PanningTool never gets the chance to run
                box: $$(go.Part,
                       { layerName: "Tool" },
                       $$(go.Shape,
                         { name: "", fill: "white", stroke: "cyan", strokeWidth: 2 })
                     ),
                archetypeNodeData: { color: "white" }, // initial properties shared by all nodes
                insertPart: function(bounds) 

                {  // override DragCreatingTool.insertPart
                  // use a different color each time
                  this.archetypeNodeData.color = go.Brush.randomColor();
                  // call the base method to do normal behavior and return its result
                  return DragCreatingTool.prototype.insertPart.call(this, bounds);
                }
            })
        );


    $('#ToolEnabled').on('click', (function(event) {
        toolEnabled();
    }));

    function toolEnabled() {
        var enable = document.getElementById("ToolEnabled").checked;
        var tool = diagram.toolManager.findTool("DragCreating");
        if (tool !== null) tool.isEnabled = enable;
    }
    
    */

    //var img =
    //addImage(img); // Adds the image to a DIV below

    $('#afficher_img').on('click', (function(){
        $('#img_result').append(diagram.makeImage({ 
            background: "AntiqueWhite"
        }));
        // alert('affichage de l\'image du diagramme');
    }));


	$('#save').on('click', (function(){
		save();
        // alert('affichage de l\'image du diagramme');
	}));
    
    // this function is the Node.dragComputation, to limit the movement of the parts
    function stayInFixedArea(part, pt, gridpt) {
        var diagram = part.diagram;
        if (diagram === null) return pt;
        // compute the document area without padding
        var v = diagram.viewportBounds.copy();
        v.subtractMargin(diagram.padding);
        // get the bounds of the part being dragged
        var b = part.actualBounds;
        var loc = part.location;
        // now limit the location appropriately
        var x = Math.max(v.x, Math.min(pt.x, v.right - b.width)) + (loc.x - b.x);
        var y = Math.max(v.y, Math.min(pt.y, v.bottom - b.height)) + (loc.y - b.y);
        return new go.Point(x, y);
    }

    // save a model to and load a model from Json text, displayed below the Diagram
    function save() {
        
        // var model_json = document.getElementById("workplace").value; 

        var model_json = diagram.model.toJson();
        var $site_url = $('#site_url').attr('class');
        var architecture_name = $('#architecture_name').val();
        var architecture_desc = $('#architecture_description').val();
        // console.log(model_json);

        //Original 
        /*$.ajax({
                url: $site_url+'/Administration/recuperation_model_json_architecture',
                method: "POST",
                data: {
                    model_json: model_json,
                    service_name: service_name
                },
                success:function (data) {

                    console.log(data);
                    $('#id_architecture').attr('value', data);
                    // alert('Service crée avec succès !!');
                }
        });*/

        //architectur creation module extended
        $.ajax({
                url: $site_url+'/Administration/save_new_architecture',
                method: "POST",
                data: {
                    model_json: model_json,
                    architecture_name: architecture_name,
                    architecture_desc: architecture_desc
                },
                success:function (data) {

                    console.log(data);
                    $('#architecture_name').val('');
                    $('#architecture_description').val('');
                    alert('Architecture créée avec succès !!');
                },
                error: function() {
                    alert('Echec de céation de l\'Architecture !!');
                }
        });
    }

});