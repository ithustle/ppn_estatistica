$(function() {
	var ctxProdutos = document.getElementById("produtos");
	var ctxProdutosIn = document.getElementById("produtosIn");
	var ctxProv = document.getElementById("provincia").getContext('2d');
	var senha = document.getElementById("senha");

	$("#painel_insercao").css("display", "none");
	$("#fundo").css("display", "none");
	$("#contentButton").css("display", "none");

	addCommas = (nStr) => {
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? ',' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + '.' + '$2');
		}
		return x1 + x2;
	}

	estatistica = () => {
		$.getJSON('./controllers/controllerGetEstatisticas.php', (data) => {

			var myChart2 = new Chart(ctxProv, {
			    type: 'line',
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

			let produtosActivos = [];
			let produtores = [];
			let quantidadeActivos = [];
			let telefones = [];

			for (let i in data[2]) {
				//produtosActivos.push(`${data[2][i].produtos} (${data[2][i].unidades})`);
				//quantidadeActivos.push(`${data[2][i].quantidade}`);
				produtosActivos.push({ label: `${data[2][i].produtos} - ${addCommas(data[2][i].quantidade)} ${data[2][i].unidades}`,  y: parseInt(data[2][i].quantidade) })
			}

			/*var myChart3 = new Chart(ctxProdutos, {
			    type: 'bar',
			    data: {
			        labels: produtosActivos,
			        datasets: [{
			            label: ["1", "ok", "oks"],
			            data: quantidadeActivos,
			            backgroundColor: [
			                'rgb(255, 99, 132)',
			                'rgb(54, 162, 235)',
			                'rgb(255, 206, 86)',
			                'rgb(75, 192, 192)',
			                'rgb(153, 102, 255)',
			                'rgb(255, 159, 64)',
			                'rgb(215, 159, 74)',
			                'rgb(55, 139, 74)',
			                'rgb(225, 129, 84)',
			                'rgb(155, 59, 94)',
			            ],
			            borderWidth: 1
			        }]
			    }
			});*/
			
			console.log(produtosActivos)
			var options = {
				title: {
					text: "Top 15 de Produtos"              
				},
				data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "doughnut",
						dataPoints: produtosActivos,
						indexLabelPlacement: "outside",
					}
				]
			};
			
			
			$("#chartContainer").CanvasJSChart(options);

			for (let i=0; i < data[2].length; i++) {
				produtores.push(` ${data[3][i].produtos} - ${addCommas(data[3][i].quantidade)} ${data[3][i].unidades}`);
			}

			$(".marquee").append(`<p>Produtos:${produtores}</p>`);
        });
	}

	estatistica();

	entrar = () => {
		$("#painel_insercao").css("display", "block");
		$("#fundo").css("display", "block");
	}

	$("#fundo").on("click", () => {
		$("#painel_insercao").css("display", "none");
		$("#fundo").css("display", "none");
	});

	senha.addEventListener("keyup", async (event) => {
		event.preventDefault();
		if (event.keyCode === 13) {
			$("#contentButton").css("display", "block");
			$.post('./controllers/controllerPassword.php', { password: senha.value }, (data) => {
				if (data === "") {
					$("#contentButton").html("<p id='msg'>Palavra-passe incorrecta.</p>");
					$("#senha").val("");
				} else {
					$("#contentButton").html('<button type="button" id="enviar" onclick="enviar()">Enviar</button>');
					$("#senha").val("");
				}
			});
		}
	});

	enviar = () => {
		let formData = new FormData();

		const ins = document.getElementById('ficheiros').files.length;
		for (var x = 0; x < ins; x++) {
			formData.append('ficheiros[]', $('input[type=file]')[0].files[x]);
		}

		$("#contentButton").html("<img src='../img/load.gif' height='20' />");

        $.ajax({
            url: "./controllers/controllerExcel.php",
            method: "POST",
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                if (data) {
					window.location.reload();
				}
            }
        });
	}
});