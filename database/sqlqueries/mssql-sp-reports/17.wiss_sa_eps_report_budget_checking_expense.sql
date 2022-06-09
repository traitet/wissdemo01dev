USE [SIAM_EPSDB]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_eps_report_budget_checking_expense]    Script Date: 24/05/2022 4:11:08 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- [wiss_sa_eps_report_budget_checking_expense]
-- Created by :  PnATTAWUT JAIDEE
-- Created date : 09-05-2022
-- Updated date : 09-05-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_sa_eps_report_budget_checking_expense]
@doc_num AS VARCHAR(30),
@period AS VARCHAR(255)
AS

     SELECT  D.DEPARTMENTID AS [DEPT. ID], D.NAME AS [DEPT. NAME],   E.EXPENSEID, E.[DESCRIPTION] AS [EXPENSE NAME], E.AMOUNT AS BUDGET,    E.ADDAMOUNT1 AS ADDITION,
 E.CANCELAMOUNT AS CANCEL,     E.NUMERIC1 AS [PR ON SAP], E.NUMERIC2 AS [PR ON EPS], (E.NUMERIC1 + E.NUMERIC2) AS [TOTAL PR],   E.ADDAMOUNT2 AS [PO ON SAP],
 E.PETTYCASH_AMOUNT AS [PO ON EPS], (E.ADDAMOUNT2 + E.PETTYCASH_AMOUNT) AS [TOTAL PO],   E.DIRECTPAYMENT_AMOUNT AS ACTUAL,  E.REMAINAMOUNT  AS REMAINING
 FROM TM_EXPENSE E
 LEFT JOIN TM_DEPARTMENT D ON E.DEPARTMENTID = D.DEPARTMENTID
 WHERE
 E.EXPENSEID = @doc_num
 AND LEFT(E.PERIOD,4) = @period
 ORDER BY E.DEPARTMENTID



-- EXEC wiss_sa_eps_report_budget_checking_expense '61830-B200' ,'SAP'

