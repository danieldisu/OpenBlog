var Dashboard = {};

Dashboard.init = function(){
    console.log('Dashboard iniciado');
    Dashboard.drawCategorias();
    Dashboard.drawOther();
}

Dashboard.drawCategorias = function(){
  $.get('paneladmin/src/getNumPostCategoria.php', function(data){
    var infoCategorias = JSON.parse(data);

    var info = {};

    info.title = {
      text: "Post por categoria",
    }

    //info.data = [];

    dataPoints = [];

    var total = infoCategorias.totalPosts;

    for (var i = 0; i < infoCategorias['totalCategorias']; i++) {
      console.log(infoCategorias[i]);
      dataPoint = {};

      dataPoint.y = getPorcentaje(infoCategorias[i].numPosts ,infoCategorias.totalPosts);
      dataPoint.legendText = infoCategorias[i].nombre;
      dataPoint.indexLabel = infoCategorias[i].nombre +"("+ infoCategorias[i].numPosts+")";

      dataPoints.push(dataPoint);
    };

    info.data =  [
        {
          type: "pie",
          showInLegend: true,
          dataPoints: dataPoints
       }
      ]

    var chart = new CanvasJS.Chart("chartContainer", info)

    chart.render();


    function getPorcentaje(num, total){
      return porcentaje = (num*100) / total;
    }
  })

}

Dashboard.drawOther = function(){
      var chart = new CanvasJS.Chart("chartContainer2",
    {
      theme: "theme2",
      title:{
        text: "Gaming Consoles Sold in 2012",
      },
      legend:{
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      data: [
      {       
       type: "pie",
       showInLegend: true,
       dataPoints: [
       {  y: 4181563, legendText:"PS 3", indexLabel: "PlayStation 3" },
       {  y: 2175498, legendText:"Wii", indexLabel: "Wii" },
       {  y: 3125844, legendText:"360", indexLabel: "Xbox 360" },
       {  y: 1176121, legendText:"DS" , indexLabel: "Nintendo DS"},
       {  y: 1727161, legendText:"PSP", indexLabel: "PSP" },
       {  y: 4303364, legendText:"3DS" , indexLabel: "Nintendo 3DS"},
       {  y: 1717786, legendText:"Vita" , indexLabel: "PS Vita"},
       ]
     }
     ]
   });

    chart.render();
  
}


