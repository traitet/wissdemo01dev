USE [SIAM_EPSDB];
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- [eps_interface_sap_pr_outstanding]
-- Created by : Satit Po
-- Created date : 23-02-2022
-- Updated date : 05-03-2022
-- =========================================================
ALTER PROCEDURE [dbo].[eps_interface_sap_pr_outstanding]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(30),
@record_count AS INT
AS
  SELECT TOP (@record_count )
        PFH.PRNUM, PFH.ISSUEDDATE, PFH.ISSUEDTIME, PFH.CURRENTUSER,
        PFH.NEXTUSER, PFH.VENDORID, PFH.VENDORNAME, PFH.SECTIONID,
        PFH.BUDGETTYPE, PFH.AMOUNT, PFH.TAXAMOUNT,
        PFH.TOTALAMOUNT, PFH.RELSTATEGY, PFH.[DESCRIPTION],
        PFH.REMARK, PFH.STATUS, PFH.CREATEDBY,
        PFH.CREATEDDATE, PFH.CREATEDTIME, PFH.EDITEDBY, PFH.EDITEDDATE,
        PFH.EDITEDTIME, PFH.ENABLED
    FROM
        TT_PRFORM PFH LEFT JOIN TT_PRFORM_LINE PFL ON PFL.PRNUM = PFH.PRNUM
    WHERE
        PFH.STATUS IN ('ISSUE', 'ONLINE', 'PREAPPR', 'APPROVED', 'REJECTED') AND
        PFH.PRNUM NOT IN ('PR00000001','PR00000002') AND
        PFH.CREATEDDATE >= @start_date AND
        PFH.CREATEDDATE <= @end_date  AND
        -- PFL.EXPENSEID = '55400-H100' AND
        PFH.PRNUM LIKE '%' + @doc_num + '%'
    ORDER BY
        PFH.PRNUM, PFL.ITEMNO ASC




-- EXEC eps_interface_sap_pr_outstanding '20190101', '20220101','',100
