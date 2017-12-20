$(document).ready(function () {
	//$(".draggable").draggable();

	var $$ = go.GraphObject.make;

	var diagram = $$(go.Diagram, "bloc_edition",
			{
				initialContentAlignment: go.Spot.Center,
				"linkingTool.direction": go.LinkingTool.ForwardsOnly,
				"undoManager.isEnabled": true
			} 
	);

	// initialize the main Diagram
  	diagram.allowDrop = true;  // permit accepting drag-and-drops

  	diagram.nodeTemplate = $$(go.Node, "Auto",
      $$(go.Picture, 
        { 
    	  	margin: 2,
    	  	width: 35, 
    	  	height: 50, 
    	  	//fill: "white" 
    	},
    	
    	// $$(go.Shape,
    	// 	"Rectangle",
    	// 	{ 
     //    		portId: "port", 
     //    		fromLinkable: true, 
     //    		toLinkable: true 
     //    		//cursor: "pointer" 
     //    	}
    	// ),
    	{
    		portId: "",
    		fromLinkable: true, 
    	    toLinkable: true,
    	    //cursor: "url(img/pencil.png) 1 1"
    	},
    	new go.Binding("source")
    	)
   	);

  // start off with no Parts
  diagram.undoManager.isEnabled = true;

  // create the Palette
  var myPalette = $$(go.Palette, "palette");

  // the Palette's node template is different from the main Diagram's
  	myPalette.nodeTemplate = $$(go.Node, "Horizontal",
    	$$(go.Picture,
    	  	/*{
    	  		stroke: 1,
    	  		color: ""
    	  	},*/
    	  	{ 	
    	  		margin: (2,3),
    	  		width: 22, 
    	  		height: 28 
    	  		//fill: "white" 
    	  	},
    	  	new go.Binding("source")
    	 ),
    	$$(go.TextBlock,
    		"vertical",
    		{
    			//textAlign: "center",
    			stroke: "black",
    	  		isMultiline: true,
    			font: "12px sans-serif",
    			row: 0, column: 5, columnSpan: 5,
    			wrap: go.TextBlock.WrapFit
    		},
    	  	new go.Binding("text", "name")
    	)
    );

  	// the list of data to show in the Palette
  	myPalette.model.nodeDataArray = 
  	[
    	{ 
    		key: "C", 
    		name: "serveur",
    		source: "img/eqpmt/serveur.png" 
    	},
    	{ 
    		key: "LC", 
    		name: "serveur appli mobile",
    		source: "img/eqpmt/serveur_app_mobiles.png" 
    	},
    	{ 
	
    		key: "A", 
    		name: "Serveur de messagerie",
    		source: "img/eqpmt/serveur_mail.png"
    	},
    	{ 
    		key: "T", 
    		name: "Ordinateur central",
    		source: "img/eqpmt/ordinateur_central.png"
    	},
    	{ 
    		key: "PB", 
    		name: "serveur applications",
    		source: "img/eqpmt/serveur_application.png" 
    	},
    	{ 
    		key: "LB", 
    		name: "serveur de bases de donnees",
    		source: "img/eqpmt/serveur_de_bd.png" 
    	},
    	{ 
    		key: "LSB", 
    		name: "serveur de donnees",
    		source: "img/eqpmt/serveur_donnees.png" 
    	},
    	{ 
    		key: "LSB", 
    		name: "nuage",
    		source: "img/eqpmt/nuage_noir.png" 
    	},{ 
    		key: "LSB", 
    		name: "desktop",
    		source: "img/eqpmt/desktop.png" 
    	},
    	{ 
    		key: "DSB", 
    		name: "serveur de fichiers",
    		source: "img/eqpmt/serveur_fichier.png" 
    	}
  	];
});