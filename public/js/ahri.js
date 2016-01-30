/*
	Ahri.js
	By powered vinicius alves;
*/
$(function(){

	$('body').on('click', '#openModel' ,function(e){
		e.preventDefault();
		$('.small.modal').modal('show');
	});

	$('body').on('click', '.buy' ,function(e){
		e.preventDefault();
		var player_id = $(this).data('id');
		var player_role = $(this).data('role');
		var recuperar_id = $('#buy_'+player_id);

		$.ajax({
			method: 'POST',
			url: 'modules/core/buy.php',
			data:{PlayerID: player_id, PlayerRole: player_role},
			dataType: 'json',
			beforeSend: function(){
				$('#buy_'+player_id).addClass('loading');
			},
			success: function(result){
				$('.buy').removeClass('loading');
				if(result.Status == 'NOT_MONEY')
				{		
					$('#buy_'+player_id).text('Dinheiro insuficiente');
					$('.segment').dimmer('show');
				}
				else if(result.Status == 'EXISTS_PLAYER')
				{
					$('#buy_'+player_id).text('Jogador já contratado');
				}
				else
				{
					$('#buy_'+player_id).text('Jogador contratado');
					$('#buy_'+player_id).addClass('hidden');
				}
			}
		});
		return false;
	});
	$('#Create').on('click',function(e){
		e.preventDefault();
		var team_name = $('input[name=Team_Name]').val();
		var team_sponsor = $('#Team_Sponsor option:selected').val();
		var team_onwer = $('input[name=Team_Onwer]').val();
		if(team_name == '')
		{
			$('#Org').addClass('error');
		}
		else{
			$.ajax({
				method: 'POST',
				url: 'modules/core/create.php',
				data: {Team_Name: team_name, Team_Sponsor: team_sponsor, Team_Onwer: team_onwer},
				dataType: 'json',
				beforeSend: function(){
					$('#Create').addClass('loading');	
				},
				success: function(result){
					if(result.Status == 'OK')
					{
						location.reload();
						$('#Create').removeClass('loading');
						$('#Create').text('Time Criado com sucesso');
					}
					else if(result.Status == 'NAME_EXIST')
					{
						$('#Create').removeClass('loading');
						$('#Create').text('O Nome da Equipe que você digitou está em uso tente outro');
					}
					else
					{
						$('#Create').removeClass('loading');
						$('#Create').text('Ops! algo deu errado contante o administrador do sistema');
					}
				}
			});
		}
		return false;
	});
});