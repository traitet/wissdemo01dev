USE [SIAM_EPSINFDB]
GO
/****** Object:  StoredProcedure [dbo].[interface_sap_inv]    Script Date: 23/02/2022 3:39:54 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- interface-sap-inv
-- Created by : Nuttawut
-- Created date : 23-02-2022
-- Updated date : 23-02-2022
-- =========================================================
ALTER PROCEDURE [dbo].[interface_sap_inv]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(8),
@record_count AS INT,
@inv_num AS VARCHAR(8)
AS
BEGIN
    -- DECLARE @start_dateAS VARCHAR(8) = '20190524'
    -- DECLARE @end_date AS VARCHAR(8) = '20210524'
    -- DECLARE @doc_num AS VARCHAR(100) = ''
    -- DECLARE @record_count AS INT = 100
    SELECT top (@record_count )
    RIDTTINV, INVDATE, INVNUM, PONUM, ITEMID, POSTINGDATE, TOTAMT, TAXAMT, BUSPLACE, DESCRIPTION, QUANTITY, CREATEDDATE,
    IFSTATUS, IFMESSEGE, SAPINVDOC, SAPINVDOCYEAR, SAPINVITEMID, OPTFIELD1, OPTFIELD2, OPTFIELD3, OPTFIELD4, OPTFIELD5, OPTFIELD6, OPTFIELD7 
    FROM TTIFINV
    WHERE 
    IFSTATUS = 'E' AND 
    POSTINGDATE >= @start_date AND 
    POSTINGDATE <= @end_date AND 
    PONUM LIKE '%' + @doc_num + '%' AND
	INVNUM LIKE '%' + @inv_num + '%' 
    ORDER BY RIDTTINV, PONUM
END


-- EXEC [interface_sap_inv] '20190101', '20220101','',100,''