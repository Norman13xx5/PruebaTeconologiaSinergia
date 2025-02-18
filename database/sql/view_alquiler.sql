CREATE VIEW informe_alquiler AS 
SELECT 
    r.id,
    r.idMaquinaria,
    r.idContrato,
    r.codFicha,
    m.placa,
    r.manifiesto,
    r.fechaInicio,
    r.fechaFin,
    c.titulo,
    r.hraOpInicio,
    r.hraOpFin,
    r.horometroInicio,
    r.horometroFin,
    (r.horometroFin - r.horometroInicio) AS totalHoras,
    a.standBy,
    a.tarifa,
    ((r.horometroFin - r.horometroInicio) * a.horaTarifa) AS subTotal,
    d.admon,
    d.reteFuente,
    d.reteica,
    d.anticipo,
    d.otros,
    (
        ((r.horometroFin - r.horometroInicio) * a.horaTarifa) - 
        (
            IFNULL(d.admon, 0) + 
            IFNULL(d.reteFuente, 0) + 
            IFNULL(d.reteica, 0) + 
            IFNULL(d.anticipo, 0) + 
            IFNULL(d.otros, 0)
        )
    ) AS total,
    a.clienteProveedor,
    r.nit
FROM registros r
JOIN maquinarias m ON r.idMaquinaria = m.id
JOIN contratos c ON r.idContrato = c.id
JOIN acuerdos a ON c.id = a.idContrato AND m.id = a.idMaquinaria
LEFT JOIN deducibles d ON r.id = d.idRegistro
WHERE r.deleted_at IS NULL
AND r.status = 1
AND a.status = 1
AND r.modulo = 'alquiler'
AND a.modulo = 'alquiler'
ORDER BY r.fechaInicio DESC