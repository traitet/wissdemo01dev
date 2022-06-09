USE [SIAM_EPSDB];
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- [eps_interface_pr_po_to_planner]
-- Created by : Satit Po.
-- Created date : 23-02-2022
-- Updated date : 05-03-2022
-- PR that not generated to planner
-- =========================================================
ALTER PROCEDURE [dbo].[eps_interface_pr_po_to_planner]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(30),
@record_count AS INT
AS
    SELECT top (@record_count )
        PRNUM, CREATEDDATE, CREATEDBY, CURRENTUSER,NEXTUSER,VENDORNAME,AMOUNT,VENDORNAME,DESCRIPTION
    FROM TT_PRFORM
    WHERE
        TEXT1 = 'GENERATED' AND
        PRNUM LIKE '%' + @doc_num + '%' AND
        CREATEDDATE >= @start_date AND
        CREATEDDATE <= @end_date AND
        TT_PRFORM.PRNUM NOT IN (SELECT PRNUM FROM TT_PRITEM)

-- EXEC eps_interface_pr_po_to_planner '20210101', '20220101','PR',100
