$(document).ready(function () {
	$('#action_menu_btn').click(function () {
		$('.action_menu').toggle();
	});
	$('#action_menu_btn2').click(function () {
		// $('.action_menu').toggle();
		$(".chat2").hide(500)
		$(".chat1").show(900)
		$("#action_menu_btn").show(800)
		$("#action_menu_btn2").hide(700)

	});
	getConversationRecente()
	getgetConversations($(".id_receiver").text())
	// teste()
	setInterval(() => {
		getgetConversations($(".id_receiver").text())
		getConversationRecente()
		// teste()
	}, 1000);

	// function teste(){
	// 	let ecran = window.innerWidth
	// 	if (ecran <= 766) {
	// 		$(".chat2").css({
	// 			display : "none"
	// 		})
	// 	}else{
	// 		$(".chat2").css({
	// 			display : "block"
	// 		})
	// 	}
	// }

	let pseudoAll = document.querySelectorAll(".pseudo-allUsers")

	for (let i = 0; i < pseudoAll.length; i++) {
		const element = pseudoAll[i];

		element.addEventListener("click", function (e) {
			e.preventDefault()


			$(".chat1").hide(200)
			$(".chat2").show(800)
			$("#action_menu_btn").hide(700)
			$("#action_menu_btn2").show(600)


			$(".msg_card_body").empty()

			let pseudo = $(this).attr("data-pseudo")
			let id = $(this).attr("data-id")
			setTimeout(() => {
				getgetConversations(id)
			}, 500);
			let image = $(this).attr("data-image")
			$(".img-receiver").text(image)
			setTimeout(() => {
				$(".chat").removeClass("d-none")
				$(".nomUserstoSendMessage").text(pseudo)
				$(".id_receiver").text(id)
				$(".imgTosendMessage").attr("src", "public/image/" + image)
			}, 500);

		})
	}

	$(".send_btn").click(function (e) {
		e.preventDefault();
		let idSender = $(".id_connecte").text()
		let idReceiver = $(".id_receiver").text()
		let contenu = $(".type_msg").val()

		$.ajax({
			type: "post",
			url: "http://localhost/chat2/MessageControlleur/sendNewMessage",
			data: {
				"idSender": idSender,
				"idReceiver": idReceiver,
				"contenu": contenu
			},
			dataType: "json",
			success: function (response) {
				console.log(response);
				$(".type_msg").val("")
				getgetConversations(idReceiver)

			}
		});

	});

	function getgetConversations(idReceiver) {
		let clasMessage = null
		let containMessage = ""
		let classContainer = null
		let classImage = null
		$.ajax({
			type: "post",
			url: "http://localhost/chat2/MessageControlleur/getConversations",
			data: {
				"idReceiver": idReceiver
			},
			dataType: 'json',
			success: function (response) {
				let idS = response['idSender']
				let MessageEntreDeux = response['MessageEntreDeux'];

				let totalMessage = response['totalMessage']

				$(".totalMessage").empty()
				$(".totalMessage").text(totalMessage + " message(s)")

				MessageEntreDeux.forEach(message => {
					clasMessage = (message['idSender'] == idS) ? "msg_cotainer_send" : "msg_cotainer"

					classContainer = (message['idSender'] == idS) ? "justify-content-end mb-4" : "justify-content-start mb-4"

					classImage = (clasMessage == "msg_cotainer") ? `<div class="img_cont_msg">
									<img src="public/image/${$('.img-receiver').text()}" class="rounded-circle user_img_msg">
								</div>` : ""


					containMessage += `
							<div class="d-flex ${classContainer}">
								
							${classImage}
								<div class="${clasMessage}">
									${message['contenu']} <br>
								</div>
							</div>
					`

					$(".msg_card_body").html(containMessage)
				});

			}
		});

	}

	function getConversationRecente() {
		let containMessage = ""
		let image = ""
		let vous = ""
		$.ajax({
			type: "get",
			url: "http://localhost/chat2/MessageControlleur/getConversationRecente",
			data: "",
			dataType: 'json',
			success: function (response) {
				let conversationRecente = response['conversationRecente'];
				let id_connecte = response['idUsers']
				$(".contacts").empty()
				conversationRecente.forEach(message => {
					if (id_connecte == message['idSender']) {
						vous = "Vous :"
					} else {
						vous = ""
					}


					image = (message['image'] === null) ? "noProfil.png" : message['image']
					containMessage = `
						<li class="each-conversation border-bottom" style="cursor:pointer" data-id="${message['idUsers']}" data-pseudo="${message['pseudo']}" data-image="${image}">
							<div class="d-flex bg-highlight px-3">
								<div class="img_cont">
									<img src="public/image/${image}" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span class="text-capitalize ">${message['pseudo']}</span>
									<p>${vous} ${message['last_message']}</p>
								</div>
							</div>
						</li>`

					$(".contacts").append(containMessage)
				});
			}
		});
	}


	$(document).on("click", ".each-conversation", function (e) {
		e.preventDefault();
		// clear current messages and show selected conversation
		$(".msg_card_body").empty();

		let idReceiver = $(this).data('id');
		let pseudo = $(this).data('pseudo');
		let image = $(this).data('image');
		console.log(image);


		$(".chat2").show(700)
		$(".chat1").hide(800)
		$("#action_menu_btn").hide(800)
		$("#action_menu_btn2").show(700)
		// load conversation then update UI
		setTimeout(() => {
			getgetConversations(idReceiver);
		}, 200);

		$(".img-receiver").text(image)
		setTimeout(() => {
			$(".chat").removeClass("d-none");
			$(".nomUserstoSendMessage").text(pseudo);
			$(".id_receiver").text(idReceiver);
			$(".imgTosendMessage").attr("src", "public/image/" + image);
		}, 250);
	});


	//  $(".log-out").on("click",function(e){
	// 	e.preventDefault()
	// 	alert('je js')
})