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
					' upper(concat(prod.descricao, " - ", mapr.descricao)) LIKE concat("%", upper(?), "%")' .
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
					' user.cpf LIKE concat("%", ?, "%")' .
			' )',

	'clientesMaisRentaveis' =>
		'SELECT' .
			' concat(user.name, " ", user.surname) AS "nome",' .
			' sum(comp.valor_total) AS "lucro"' .
		' FROM' .
			' compras comp' .
			' INNER JOIN users user ON (comp.cliente_id = user.id)' .
		' GROUP BY user.id' .
		' ORDER BY 2 DESC',

	'clientesMaisFrequentes' =>
		'SELECT' .
			' concat(user.name, " ", user.surname) AS "nome",' .
			' count(user.id) as "frequencia"' .
		' FROM' .
			' compras comp' .
			' INNER JOIN users user ON (comp.cliente_id = user.id)' .
		' GROUP BY user.id' .
		' ORDER BY 2 DESC',

	'produtosMaisVendidos' =>
		'SELECT ' .
			' prod.id AS "produto_id",' .
			' prod.descricao AS "produto_descricao",' .
			' count(prod.id) AS "frequencia"' .
		' FROM' .
			' compras comp' .
			' INNER JOIN item_compra itco ON (comp.id = itco.compra_id)' .
			' INNER JOIN produtos prod ON (itco.item_id = prod.id)' .
		' GROUP BY prod.id' .
		' ORDER BY 2 DESC',

	'servicosMaisVendidos' =>
		'SELECT ' .
			' serv.id AS "servico_id",' .
			' serv.descricao AS "servico_descricao",' .
			' count(serv.id) AS "frequencia"' .
		' FROM' .
			' compras comp' .
			' INNER JOIN item_compra itco ON (comp.id = itco.compra_id)' .
			' INNER JOIN servicos serv ON (itco.item_id = serv.id)' .
		' GROUP BY serv.id' .
		' ORDER BY 2 DESC',

	'movimentoSemanal' =>
		'SELECT' .
			' weekday(comp.data_compra) AS "dia",' .
			' count(comp.id) AS "frequencia"' .
		' FROM' .
			' compras comp' .
		' GROUP BY 1' .
		' ORDER BY 2 DESC',

	'movimentoMensal' =>
		'SELECT' .
			' dayofmonth(comp.data_compra) AS "dia",' .
			' count(comp.id) AS "frequencia"' .
		' FROM' .
			' compras comp' .
		' GROUP BY 1' .
		' ORDER BY 2 DESC',

	'clientesPorSexo' =>
		'SELECT' .
			' user.sexo AS "sexo",' .
			' count(user.sexo) AS "quantidade"' .
		' FROM' .
			' users user' .
		' GROUP BY user.sexo',

	'clientesPorFaixaEtaria' =>
		'SELECT' .
			' count(user.id) as "quantidade"' .
		' FROM' .
			' users user' .
		' WHERE' .
			' timestampdiff(year, user.data_nascimento, now()) BETWEEN ? AND ?',

];