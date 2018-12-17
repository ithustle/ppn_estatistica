$(function() {
	var ctxProd = document.getElementById("produtores");
	var ctxProdutos = document.getElementById("produtos");
	var ctxProv = document.getElementById("provincia").getContext('2d');


	estatistica = () => {
		$.getJSON('./controllers/controllerGetEstatisticas.php',(data) => {
            console.log(data);

            var myChart1 = new Chart(ctxProd, {
			    type: 'doughnut',
			    data: {
			        labels: ["Registados", "Activos", "Inactivos"],
			        datasets: [{
			            data: data[1],
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.7)',
			                'rgba(54, 162, 235, 0.7)',
			                'rgba(255, 206, 86, 0.7)',
			                'rgba(75, 192, 192, 0.7)',
			                'rgba(153, 102, 255, 0.7)',
			                'rgba(255, 159, 64, 0.7)'
			            ],
			            borderColor: [
			                'rgba(255,99,132,1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			                'rgba(75, 192, 192, 1)',
			                'rgba(153, 102, 255, 1)',
			                'rgba(255, 159, 64, 1)'
			            ],
			            borderWidth: 1
			        }]
			    }
			});

			var myChart2 = new Chart(ctxProv, {
			    type: 'horizontalBar',
			    data: {
			        labels: ["Bengo", "Benguela", "Bié", "Cabinda", "C. Cubando", "C. Norte", "C. Sul", "Cunene", "Huambo", "Huíla", "Luanda", "L. Norte", "L. Sul", "Malanje", "Moxico", "Namibe", "Uíge", "Zaire"],
			        datasets: [{
			            label: 'Províncias',
			            data: data[0],
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.5)',
			                'rgba(54, 162, 235, 0.5)',
			                'rgba(255, 206, 86, 0.5)',
			                'rgba(75, 192, 192, 0.5)',
			                'rgba(153, 102, 255, 0.5)',
			                'rgba(255, 159, 64, 0.5)'
			            ],
			            borderColor: [
			                'rgba(255,99,132,1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			                'rgba(75, 192, 192, 1)',
			                'rgba(153, 102, 255, 1)',
			                'rgba(255, 159, 64, 1)'
			            ],
			            borderWidth: 1
			        }]
			    }
			});

			var myChart3 = new Chart(ctxProdutos, {
			    type: 'bar',
			    data: {
			        labels: ["Cimento", "Banana"],
			        datasets: [{
			            label: 'Províncias',
			            data: [3, 23],
			            backgroundColor: [
			                'rgb(255, 99, 132)',
			                'rgb(54, 162, 235)',
			                'rgb(255, 206, 86)',
			                'rgb(75, 192, 192)',
			                'rgb(153, 102, 255)',
			                'rgb(255, 159, 64)'
			            ],
			            borderColor: [
			                'rgba(255,99,132,1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			                'rgba(75, 192, 192, 1)',
			                'rgba(153, 102, 255, 1)',
			                'rgba(255, 159, 64, 1)'
			            ],
			            borderWidth: 1
			        }]
			    }
			});
        });
	}

	estatistica();
});