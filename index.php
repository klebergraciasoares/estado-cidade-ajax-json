<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visita Checkin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Nova Verificação Estoque Rota</h2>
        <form method="POST">

            <input type="hidden" class="d-id_user" id="id_user" name="id_user" value="<?php echo($id); ?>">

            <!-- Linha 1: Cliente e CPF --> 
            <div class="row form-row">
                <div class="col-md-6">
                    <h4>Cliente:</h4>
                    <select id="id_customer" name="id_customer" class="form-control mb-3" style="width: 100%;">
                        <option value="">Selecione um Cliente</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?php echo $customer['id']; ?>">
                                <?php echo htmlspecialchars($customer['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Documento</label>
                    <input type="text" id="document_number" name="document_number" class="form-control" required>
                </div>
            </div>

            <!-- Linha 2: Endereço e Bairro -->
            <div class="row form-row">
                <div class="col-md-6">
                    <label class="form-label">Endereço</label>
                    <input type="text" id="endereco" name="endereco" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bairro</label>
                    <input type="text" id="bairro" name="bairro" class="form-control" required>
                </div>
            </div>

            <!-- Linha 3: Telefone e Cidade -->
            <div class="row form-row">
                <div class="col-md-6">
                    <label class="form-label">Telefone</label>
                    <input type="text" id="fone" name="fone" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cidade</label>
                    <input type="text" id="cidade" name="cidade" class="form-control" required>
                </div>
            </div>

            <!-- Linha 4: Data do Acerto e Dívida Restante -->
            <div class="row form-row">
                <div class="col-md-6">
                    <label class="form-label">Data do Acerto</label>
                    <input type="datetime-local" name="data_do_acerto" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Dívida Restante</label>
                    <input type="text" name="divida_restante" class="form-control" placeholder="Ex.: 300,00">
                </div>
            </div>

            <!-- Espaçamento de duas linhas -->
            <div class="spacer"></div>
            <div class="spacer"></div>

            <!-- Linha de Valores -->
            <div class="row form-row">
                <div class="col-md-3">
                    <label class="form-label">Valor Mostruário</label>
                    <input type="text" name="valor_mostruario" class="form-control" placeholder="Ex.: 1000,00" style="background-color: #f8d7da;">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Valor Vendido</label>
                    <input type="text" name="valor_vendido" class="form-control" placeholder="Ex.: 600,00">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Valor Pago</label>
                    <input type="text" name="valor_pago" class="form-control" placeholder="Ex.: 400,00">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Dívida deste Acerto</label>
                    <input type="text" name="divida_deste_acerto" class="form-control" placeholder="Ex.: 200,00">
                </div>
            </div>

            <!-- Status e Botão -->
            <div class="mb-3 mt-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="Pendente">Pendente</option>
                    <option value="Pago">Pago</option>
                    <option value="Atrasado">Atrasado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        </form>

        <h2 class="mt-5">Lista de Visitas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                    <th>Data do Acerto</th>
                    <th>Valor Vendido</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $records = $visitamostruario->readAll($id);
                echo('<br/> id......... ' .$id);
                foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo $record['id']; ?></td>
                        <td><?php echo $record['customer_name']; ?></td>
                        <td><?php echo $record['document_number']; ?></td>
                        <td><?php echo $record['endereco']; ?></td>
                        <td><?php echo $record['data_do_acerto']; ?></td>
                        <td><?php echo number_format($record['valor_vendido'], 2, ',', '.'); ?></td>
                        <td><?php echo $record['status']; ?></td>
                        <td>
                            <a href="edit_visitamostruario.php?id=<?php echo $record['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="delete_visitamostruario.php?id=<?php echo $record['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
		$(document).ready(function() {
			$('#id_customer').select2({
				placeholder: "Selecione um Cliente",
				allowClear: true,
				width: '100%'
			});
			
			
			// Função para definir a data e hora atuais
            function setCurrentDateTime() {
                var now = new Date();
                var year = now.getFullYear();
                var month = String(now.getMonth() + 1).padStart(2, '0'); // Mês começa em 0
                var day = String(now.getDate()).padStart(2, '0');
                var hours = String(now.getHours()).padStart(2, '0');
                var minutes = String(now.getMinutes()).padStart(2, '0');
                var datetimeStr = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;

                $('#data_do_acerto').val(datetimeStr);
                $('#data_retorno').val(datetimeStr); // Opcional, pode remover se não quiser preencher data_retorno
            }

            // Chamar a função ao carregar a página
            setCurrentDateTime();			
			
			
			
			
			

			// Evento ao mudar a seleção do combobox
			$('#id_customer').on('change', function() {
                console.log('entrou................. ');
				var customerId = $(this).val();
                var id_user = $("#id_user").val();

				console.log("customer_id.... " +customerId);
				console.log('id_user.... ' +id_user);

				if (customerId) {
					// Requisição AJAX para buscar os dados do cliente
					$.ajax({
						url: 'get_customer_data.php', // Arquivo PHP que vai buscar os dados
						type: 'POST',
						data: { id: customerId, id_user: id_user },
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								// Preencher os campos com os dados retornados
								$('#document_number').val(response.data.document_number || '');
								$('#endereco').val(response.data.address || '');
								$('#bairro').val(response.data.neighbourhood || '');
								$('#fone').val(response.data.phone_primary || '');
								$('#cidade').val(response.data.city || '');
								
								$("#data_do_acerto").focus(); // Sets focus to the element with id "myInput"
								setCurrentDateTime(); // Atualiza a data e hora ao sele
							} else {
								alert('Erro ao carregar os dados do cliente.');
							}
						},
						error: function() {
							alert('Erro na requisição AJAX.');
						}
					});
				} else {
					// Limpar os campos se nenhum cliente for selecionado
					$('#document_number').val('');
					$('#endereco').val('');
					$('#bairro').val('');
					$('#fone').val('');
					$('#cidade').val('');
					setCurrentDateTime(); // Reseta a data e hora se limpar o campo
				}
			});
			
		});
    </script>
</body>
</html>