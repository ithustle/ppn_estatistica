$(function() {
	var ctxProd = document.getElementById("produtores");
	var ctxProdutos = document.getElementById("produtos");
	var ctxProdutosIn = document.getElementById("produtosIn");
	var ctxProv = document.getElementById("provincia").getContext('2d');
	var senha = document.getElementById("senha");

	$("#painel_insercao").css("display", "none");
	$("#fundo").css("display", "none");
	$("#contentButton").css("display", "none");

	estatistica = () => {
		$.getJSON('./controllers/controllerGetEstatisticas.php', (data) => {
			console.log(data)
            var myChart1 = new Chart(ctxProd, {
			    type: 'doughnut',
			    data: {
			        labels: ["Registados", "Com Produtos"],
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
				produtosActivos.push(`${data[2][i].produtos} (${data[2][i].unidades})`);
				quantidadeActivos.push(`${data[2][i].quantidade}`);
			}

			var myChart3 = new Chart(ctxProdutos, {
			    type: 'pie',
			    data: {
			        labels: produtosActivos,
			        datasets: [{
			            label: 'Top 10',
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
			});

			for (let i=0; i < data[3].length; i++) {
				produtores.push(` ${data[3][i].produtor} (${data[3][i].produtos}) - ${data[3][i].telefone}`);
			}

			$(".marquee").append(`<p>Produtores:${produtores}</p>`);
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