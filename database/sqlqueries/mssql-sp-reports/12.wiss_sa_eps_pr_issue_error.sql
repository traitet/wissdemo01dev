USE [SIAM_EPSDB]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_eps_pr_issue_error]    Script Date: 3/5/2022 12:27:24 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- eps_pr_issue_error_report
-- Created by : Satit Po
-- Created date : 23-02-2022
-- Updated date : 23-02-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_sa_eps_pr_issue_error]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(30),
@record_count AS INT
AS

    SELECT TOP(@record_count)
        PRNUM, PRKEYNO, ISSUEDDATE, ISSUEDTIME, APPROVEDDATE, APPROVEDTIME, CURRENTUSER, NEXTUSER, VENDORID, VENDORNAME, SECTIONID,
        BUDGETTYPE, AMOUNT, TAXAMOUNT, TOTALAMOUNT, RELSTATEGY, DESCRIPTION, REMARK, STATUS, CREATEDBY, CREATEDDATE,
        CREATEDTIME, EDITEDBY, EDITEDDATE, EDITEDTIME, ENABLED
    FROM
        TT_PRFORM
    WHERE
        STATUS = '' AND
        CREATEDDATE >= @start_date AND
        CREATEDDATE <= @end_date AND
        PRNUM LIKE '%' + @doc_num + '%'
    ORDER BY CREATEDDATE DESC

-- EXEC wiss_sa_eps_pr_issue_error '20170914', '20990101','PR22',100
