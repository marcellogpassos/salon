SELECT
  itve.id                                                               AS 'id',
  ifnull(serv.descricao, concat(prod.descricao, ' - ', mapr.descricao)) AS 'descricao',
  if(serv.descricao IS NULL, 'P', 'S')                                  AS 'tipoItem',
  if(serv.descricao IS NULL, prod.quantidade, NULL)                     AS 'quantidade',
  itve.valor                                                            AS 'valor'
FROM
  itens_venda itve
  LEFT JOIN servicos serv ON (serv.id = itve.id)
  LEFT JOIN produtos prod ON (prod.id = itve.id)
  LEFT JOIN marcas_produtos mapr ON (mapr.id = prod.marca_id)
WHERE
  itve.ativo = '1'
  AND (
    itve.id LIKE concat(@termo, '%')
    OR
    upper(serv.descricao) LIKE concat('%', upper(@termo), '%')
    OR (
      upper(concat(prod.descricao, ' - ', mapr.descricao)) LIKE concat('%', upper(@termo), '%')
      AND
      prod.quantidade > 0
    )
  );