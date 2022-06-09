USE [SIAM_EPSINFDB]
GO
/****** Object:  StoredProcedure [dbo].[interface_sap_rec]    Script Date: 23/02/2022 3:34:58 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- interface_sap_rec
-- Created by : Nuttawut
-- Created date : 23-02-2022
-- Updated date : 23-02-2022
-- =========================================================
ALTER PROCEDURE [dbo].[interface_sap_rec]
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
    RIDTTIFRC, RCDATE, SAPDOCNO, PONUM, ITEMID, INVNUM, POSTINGDATE, QUANTITY, STORELOC, LINEID,
    SECTIONID, IFSTATUS, IFMESSEGE, SAPMATDOCNO, SAPMATDOCYEAR, SAPITEMID, OPTFIELD1,
    OPTFIELD2, OPTFIELD3, OPTFIELD4, OPTFIELD5, OPTFIELD6, OPTFIELD7

    FROM TTIFREC
    WHERE
        IFSTATUS = 'E' and
        POSTINGDATE >= @start_date and
        POSTINGDATE <= @end_date and
        PONUM LIKE '%' + @doc_num + '%' and
        INVNUM LIKE  '%' + @inv_num + '%'
        ORDER BY RIDTTIFRC, PONUM
END


-- EXEC interface_sap_rec '20190101', '20220101','',100
