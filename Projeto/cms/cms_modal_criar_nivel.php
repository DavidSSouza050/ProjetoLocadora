<div id="segura_cadastro_nivel">
    <div id="card_cadastro">
        <form name="frm_cadastro_nivel" method="POST" action="cms_usuario">
            <div class="caixa_cadastro_nivel">
                Nome do Nivel: <input type="text" id="txt_nome_nivel" name="txt_nome_nivel">
            </div>
            <div class="caixa_cadastro_nivel">
                <select id="cmb_cadastro_nivel" name="cmb_cadastro_nivel">
                    <option>Paginas Modificaveis</option>
                    <option value="0">Todas</option>
                    <option value="1">Conteudo</option>
                    <option value="2">Fale Conosco</option>
                    <option value="3">Produtos</option>
                    <option value="4">Usuarios</option>
                </select>
            </div>
            <div id="segura_btn_cadastro_nivel">
                <input type="submit" value="Salvar" class="botao_cadastro_usuario" name="btn_cadastro_nivel">
            </div>
        </form>
    </div>
    
    <div id="segura_table" class="scrollTexto">
        <table id="table_modal_nivel">
            <tr id="thead_nivel">
                <td>
                    Nome
                </td>
                <td>
                    Opções
                </td>
            </tr>
            <tr class="tbody_nivel">
                <td>
                    Funcionario
                </td>
                <td>
                    Opções
                </td>
            </tr>
            
            
        </table>
    </div>

</div>