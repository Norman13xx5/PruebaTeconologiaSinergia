# el calculo del alquiler es el kilometraje * tarifa * mts3 - deducciones
CREATE VIEW informe_movimientos AS 
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
    (ru.origen - ru.destino) AS ruta,
    a.kilometraje,
    a.tarifa,
    r.mts3,
    r.peaje,
    (((a.kilometraje * a.tarifa * r.mts3) * r.movimientos )+ (r.peaje) ) AS subTotal,
    d.admon,
    d.reteFuente,
    d.reteica,
    d.anticipo,
    d.otros,
    (
        (((a.kilometraje * a.tarifa * r.mts3) * r.movimientos )+ (r.peaje) ) - 
        (
            IFNULL(d.admon, 0) + 
            IFNULL(d.reteFuente, 0) + 
            IFNULL(d.reteica, 0) + 
            IFNULL(d.anticipo, 0) + 
            IFNULL(d.otros, 0)
        )
    ) AS total,
    r.deleted_at,
    r.status,
    r.nit,
    a.clienteProveedor
FROM registros r
JOIN maquinarias m ON r.idMaquinaria = m.id
JOIN contratos c ON r.idContrato = c.id
JOIN acuerdos a ON c.id = a.idContrato
JOIN rutas ru ON ru.id = a.idRuta
LEFT JOIN deducibles d ON r.id = d.idRegistro
WHERE r.modulo = 'movimientos'
AND a.modulo = 'movimientos';