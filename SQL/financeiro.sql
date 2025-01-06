CREATE TABLE tbl_empresa (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE tbl_conta_pagar (
    id_conta_pagar INT AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(10,2) NOT NULL,
    data_pagar DATE NOT NULL,
    pago TINYINT(1) NOT NULL DEFAULT 0,
    id_empresa INT NOT NULL,
    FOREIGN KEY (id_empresa) REFERENCES tbl_empresa(id_empresa)
);