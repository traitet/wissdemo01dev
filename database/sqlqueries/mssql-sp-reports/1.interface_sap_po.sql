USE [SIAM_EPSINFDB]
GO
/****** Object:  StoredProcedure [dbo].[interface_sap_po]    Script Date: 23/02/2022 3:34:58 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- interface_sap_po
-- Created by : Nuttawut
-- Created date : 23-02-2022
-- Updated date : 23-02-2022
-- =========================================================
ALTER PROCEDURE [dbo].[interface_sap_po]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(8),
@record_count AS INT
AS
BEGIN
    -- DECLARE @start_dateAS VARCHAR(8) = '20190524'
    -- DECLARE @end_date AS VARCHAR(8) = '20210524'
    -- DECLARE @doc_num AS VARCHAR(100) = ''
    -- DECLARE @record_count AS INT = 100
    SELECT
    top (@record_count )
    RIDTTIFPO, PONUM, ITEMID, DOCTYPE, VENDORID, PAYMENTTERM, INCOTERM1, INCOTERM2, CURRENCYID,
    PURORG, PURGRP, COMPID, ISINVESTMENT, MATID, TXTCOMMENT, QUANTITY, UNIT, REQUIREDDATE, UNITPRICE, MATGRP,
    PLANT, VATID, DEPTID, GLACCOUNT, INVESTMENTID, PRODUCTID, MACHINEID, PRODUCTIONLINEID, REQUIREDBY, PODATE,
    CREATEDDATE, IFSTATUS, CARRYSTATUS, IFMESSAGE, OPTFIELD1, OPTFIELD2, OPTFIELD3, OPTFIELD4, OPTFIELD5, OPTFIELD6, OPTFIELD7
    FROM TTIFPO
    WHERE
    IFSTATUS = 'E' and
    PODATE >= @start_date and
    PODATE <= @end_date and
    PONUM LIKE '%' + @doc_num + '%'
    ORDER BY RIDTTIFPO, PONUM
END


-- EXEC interface_sap_po '20190101', '20220101','',100
