USE [SIAM_EPSDB]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_eps_pr_productionid_error]    Script Date: 3/5/2022 12:27:24 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- eps_pr_issue_error_report
-- Created by : Satit Po
-- Created date : 23-02-2022
-- Updated date : 03-05-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_sa_eps_pr_productionid_error]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(30),
@record_count AS INT
AS

    SELECT TOP(@record_count)
        PRNUM, ITEMNO, MATDESC, BUDGETTYPE, EXPENSEID, INVESTMENTID, PRODUCTID, PRODUCTLINEID, PRODUCTLINEDESC, MACHINEID,
        MACHINEDESC, REQUIREDDATE, SHIPTO, QTY, PRICE, UNIT, PONUM, STATUS, ENABLED, TEXT1, TEXT2
    FROM
        TT_PRITEM_LINE
    WHERE
        LEN(PRODUCTLINEID) > 10 AND
        PRNUM LIKE '%' + @doc_num + '%' AND
        REQUIREDDATE >= @start_date AND
        REQUIREDDATE <= @end_date
    ORDER BY PRNUM

-- EXEC wiss_sa_eps_pr_productionid_error '20200101', '20990101','PR22',100

