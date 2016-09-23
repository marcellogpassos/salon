SELECT 
	itve.id as 'id',
    ifnull(serv.descricao, concat(prod.descricao, ' - ', mapr.descricao)) as 'descricao',
    if(serv.descricao is null, 'P', 'S') as 'tipoItem',
    if(serv.descricao is null, prod.quantidade, null) as 'quantidade',
    itve.valor as 'valor'
FROM
	itens_venda itve
LEFT JOIN
	servicos serv ON (serv.id = itve.id)
LEFT JOIN
	produtos prod ON (prod.id = itve.id)
LEFT JOIN
	marcas_produtos mapr ON (mapr.id = prod.marca_id)
WHERE
	itve.ativo = '1'
    AND (
		itve.id like concat(@termo, '%') 
		OR 
			upper(serv.descricao) LIKE concat('%', upper(@termo), '%') 
		OR (
			upper(concat(prod.descricao, ' - ', mapr.descricao)) LIKE concat('%', upper(@termo), '%')
			AND
				prod.quantidade > 0
		)
    );