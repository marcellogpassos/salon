<?php

return [

	buscarItem =>
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

];