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
	            data: [7, 16, 5, 0],
	            backgroundColor: [	                
	                '#fc9107',	                
	                '#1fc1d5',
	                '#dc2265',
	                '#f44336'
	            ]
	        }]
	    },
	    options: {
	    	cutoutPercentage: '50',
	    }
	});

});

</script>