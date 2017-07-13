<script>
$(document).ready(function () {  
  // Area ready      
});

$(function () {

	var ctx = document.getElementById("chart_contratos");
	var chart_contratos = new Chart(ctx, {
	    type: 'doughnut',
	    data: {
	        labels: ["CV", "CP", "CC", "AF"],
	        datasets: [{	            
	            data: [{!! $cont['cv-cv-vigente'] !!}, {!! $cont['cv-cp-vigente'] !!}, {!! $cont['cv-cc-vigente'] !!}, {!! $cont['cv-af-vigente'] !!}],
	            backgroundColor: [     
	                '#ff5722',
	                '#00bcd4',
	                '#8bc34a',
	                '#9c27b0'
	            ]
	        }]
	    },
	    options: {
	    	cutoutPercentage: '65',
	    }
	});

});

</script>