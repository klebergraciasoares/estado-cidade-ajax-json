<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca Ajax de Estado e Cidade com PHP, jQuery e JSON</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f9;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .tutorial-frame {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        .tutorial-frame h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .form-group label {
            color: #34495e;
            font-weight: 500;
        }
        .form-control {
            border-radius: 8px;
            border-color: #ddd;
        }
        .select2-container .select2-selection {
            border-radius: 8px;
            border-color: #ddd;
        }
        .spacer {
            margin: 15px 0;
        }
        @media (max-width: 768px) {
            .tutorial-frame {
                padding: 20px;
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="tutorial-frame">
        <h2>Busca Ajax de Estado e Cidade</h2>
        <p class="text-muted">Selecione um estado para carregar as cidades com PHP, jQuery e JSON.</p>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control">
                        <option value="">Selecione o estado</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <select id="cidade" name="cidade" class="form-control">
                        <option value="">Selecione uma cidade</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        // Inicializa Select2 nos selects
        $('#estado, #cidade').select2({
            placeholder: "Selecione",
            allowClear: true,
            width: '100%'
        });

        // Carrega estados ao carregar a página
        $.getJSON("dados_estados_cidades.json", function (data) {
            const estados = data.states;
            $.each(estados, function (id, nome) {
                $("#estado").append(`<option value="${id}">${nome}</option>`);
            });
        });

        // Ao mudar o estado, buscar cidades
        $('#estado').on('change', function () {
            const estadoId = $(this).val();

            if (estadoId) {
                $.ajax({
                    url: 'get_cidades_por_estado.php',
                    type: 'GET',
                    data: { estado_id: estadoId },
                    success: function (data) {
                        let options = '<option value="">Selecione uma cidade</option>';
                        data.forEach(function (cidade) {
                            options += `<option value="${cidade.name}">${cidade.name}</option>`;
                        });
                        $('#cidade').html(options).trigger('change');
                    },
                    error: function () {
                        alert('Erro ao carregar cidades.');
                    }
                });
            } else {
                $('#cidade').html('<option value="">Selecione um estado primeiro</option>').trigger('change');
            }
        });
    });
    </script>
</body>
</html>