<?php

return [

	'buscarItem' =>
		'SELECT' .
			' itve.id AS "id",' .
			' ifnull(concat(itve.id, " - ", serv.descricao), concat(itve.id, " - ", prod.descricao, " (", mapr.descricao, ")")) AS "label",' .
			' if(serv.descricao IS NULL, "P", "S") AS "tipoItem",' .
			' if(serv.descricao IS NULL, prod.quantidade, NULL) AS "quantidadeDisponivel",' .
			' itve.valor AS "valor" ' .
		' FROM' .
			' itens_venda itve' .
			' LEFT JOIN servicos serv ON (serv.id = itve.id)' .
			' LEFT JOIN produtos prod ON (prod.id = itve.id)' .
			' LEFT JOIN marcas_produtos mapr ON (mapr.id = prod.marca_id)' .
		' WHERE' .
			' itve.ativo = "1" ' .
			'AND (' .
				' itve.id LIKE concat(?, "%")' .
				' OR upper(serv.descricao) LIKE concat("%", upper(?), "%")' .
				' OR (' .
					' upper(concat(prod.descricao, " - ", mapr.descricao, " - ", prod.codigo_barras)) LIKE concat("%", upper(?), "%")' .
					' AND' .
						' prod.quantidade > 0' .
				' )' .
			')',

	'buscarCliente' =>
		'SELECT' .
			' user.id AS "id",' .
			' concat(user.name, " ", user.surname) AS "label"' .
		' FROM' .
			' users user' .
		' WHERE' .
			' user.ativo = "1"' .
			' AND (' .
				' upper(concat(user.name, " ", user.surname)) LIKE concat("%", upper(?), "%")' .
				' OR' .
					' user.telefone LIKE concat("%", ?, "%")' .
			' )',

	'clientesMaisRentaveis' =>
		'SELECT' .
        	' user.id AS "id",' .
			' concat(user.name, " ", user.surname) AS "nome",' .
			' sum(comp.valor_total) AS "lucro"' .
		' FROM' .
			' compras comp' .
			' INNER JOIN users user ON (comp.cliente_id = user.id)' .
		' WHERE' .
			' comp.data_cancelamento is null' .
		' GROUP BY user.id' .
		' ORDER BY 3 DESC',

	'clientesMaisFrequentes' =>
		'SELECT' .
        	' user.id AS "id",' .
			' concat(user.name, " ", user.surname) AS "nome",' .
			' count(user.id) as "frequencia"' .
		' FROM' .
			' compras comp' .
			' INNER JOIN users user ON (comp.cliente_id = user.id)' .
		' WHERE' .
			' comp.data_cancelamento is null' .
		' GROUP BY user.id' .
		' ORDER BY 3 DESC',

	'produtosMaisVendidos' =>
		'SELECT ' .
			' prod.id AS "produto_id",' .
			' prod.descricao AS "produto_descricao",' .
			' count(prod.id) AS "frequencia"' .
		' FROM' .
			' compras comp' .
			' INNER JOIN item_compra itco ON (comp.id = itco.compra_id)' .
			' INNER JOIN produtos prod ON (itco.item_id = prod.id)' .
		' WHERE' .
			' comp.data_cancelamento is null' .
		' GROUP BY prod.id' .
		' ORDER BY 3 DESC',

	'servicosMaisVendidos' =>
		'SELECT ' .
			' serv.id AS "servico_id",' .
			' serv.descricao AS "servico_descricao",' .
			' count(serv.id) AS "frequencia"' .
		' FROM' .
			' compras comp' .
			' INNER JOIN item_compra itco ON (comp.id = itco.compra_id)' .
			' INNER JOIN servicos serv ON (itco.item_id = serv.id)' .
		' WHERE' .
			' comp.data_cancelamento is null' .
		' GROUP BY serv.id' .
		' ORDER BY 3 DESC',

	'movimentoSemanal' =>
		'SELECT' .
			' weekday(comp.data_compra) AS "dia",' .
			' count(comp.id) AS "frequencia"' .
		' FROM' .
			' compras comp' .
		' WHERE' .
			' comp.data_cancelamento is null' .
		' GROUP BY 1' .
		' ORDER BY 2 DESC',

	'movimentoMensal' =>
		'SELECT' .
			' dayofmonth(comp.data_compra) AS "dia",' .
			' count(comp.id) AS "frequencia"' .
		' FROM' .
			' compras comp' .
		' WHERE' .
			' comp.data_cancelamento is null' .
		' GROUP BY 1' .
		' ORDER BY 2 DESC',

	'movimentoAnual' =>
		'SELECT' .
			' dayofyear(comp.data_compra) AS "dia",' .
			' count(comp.id) AS "frequencia"' .
		' FROM' .
			' compras comp' .
		' WHERE' .
			' comp.data_cancelamento is null' .
		' GROUP BY 1' .
		' ORDER BY 2 DESC',

	'clientesPorSexo' =>
		'SELECT' .
			' "I" AS "sexo",' .
			' count(user.sexo) AS "quantidade"' .
		' FROM' .
			' users user' .
		' WHERE' .
			' user.sexo not in ("M", "F")' .
		' UNION' .
		' SELECT' .
			' "M" AS "sexo",' .
			' count(user.sexo) AS "quantidade"' .
		' FROM' .
			' users user' .
		' WHERE' .
			' user.sexo = "M"' .
		' UNION' .
		' SELECT' .
			' "F" AS "sexo",' .
			' count(user.sexo) AS "quantidade"' .
		' FROM' .
			' users user' .
		' WHERE' .
			' user.sexo = "F"' .
		' UNION' .
		' SELECT' .
			' "T" AS "sexo",' .
			' count(user.id) AS "quantidade"' .
		' FROM' .
			' users user',

	'clientesPorFaixaEtaria' =>
		'SELECT' .
			' count(user.id) as "quantidade"' .
		' FROM' .
			' users user' .
		' WHERE' .
			' timestampdiff(year, user.data_nascimento, now()) BETWEEN ? AND ?',

	'clientesPorBairro' =>
		'SELECT' .
			' user.municipio_id AS "municipio",' .
			' user.bairro AS "bairro",' .
			' count(*) AS "quantidade"' .
		' FROM' .
			' users user' .
		' GROUP BY user.municipio_id, user.bairro' .
		' ORDER BY 3 DESC',

	'vendas' =>
		'SELECT' .
			' count(comp.id) AS "total"' .
		' FROM' .
			' compras comp' .
		' WHERE' .
			' comp.data_compra > ?' .
			' AND comp.data_cancelamento is null',

	'receita' =>
		'SELECT' .
			' sum(comp.valor_total) - sum(comp.desconto) AS "total"' .
		' FROM' .
			' compras comp' .
		' WHERE' .
			' comp.data_compra > ?' .
			' AND comp.data_cancelamento is null',

	'novosClientes' =>
		'SELECT' .
			' count(user.id) AS "total"' .
		' FROM' .
			' users user' .
		' WHERE' .
			' user.created_at > ?',

	'servicosVendidos' =>
		'SELECT' .
			' count(itco.item_id) AS "total"' .
		' FROM' .
			' item_compra itco' .
			' INNER JOIN compras comp ON (comp.id = itco.compra_id)' .
			' INNER JOIN servicos serv ON (serv.id = itco.item_id)' .
		' WHERE' .
			' comp.data_compra > ?' .
			' AND comp.data_cancelamento is null',

	'produtosVendidos' =>
		'SELECT' .
			' count(itco.item_id) AS "total"' .
		' FROM' .
			' item_compra itco' .
			' INNER JOIN compras comp ON (comp.id = itco.compra_id)' .
			' INNER JOIN produtos prod ON (prod.id = itco.item_id)' .
		' WHERE' .
			' comp.data_compra > ?' .
			' AND comp.data_cancelamento is null',

	'agenda' =>
		'SELECT' .
			' agen.id as "id",' .
			' upper(concat(user.name, " - ", serv.descricao)) as "title",' .
			' concat(agen.data, "T", agen.hora) as "start",' .
			' concat(agen.data, "T", addtime(agen.hora, serv.duracao)) as "end"' .
		' FROM' .
			' blank.agendamentos agen' .
			' INNER JOIN users user ON (user.id = agen.cliente_id)' .
			' INNER JOIN servicos serv ON (serv.id = agen.servico_id)' .
		' WHERE' .
			' agen.data_cancelamento is null AND' .
			' agen.status = "C" AND' .
			' agen.data BETWEEN ? AND ?'
];