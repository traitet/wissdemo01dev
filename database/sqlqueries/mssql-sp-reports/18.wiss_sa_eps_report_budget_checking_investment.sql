USE [SIAM_EPSDB]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_eps_report_budget_checking_investment]    Script Date: 24/05/2022 4:11:22 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- [wiss_sa_eps_report_budget_checking_investment]
-- Created by :  PnATTAWUT JAIDEE
-- Created date : 09-05-2022
-- Updated date : 09-05-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_sa_eps_report_budget_checking_investment]
@doc_num AS VARCHAR(30),
@period AS VARCHAR(255)
AS

       SELECT  D.DEPARTMENTID AS [DEPT. ID], D.NAME AS [DEPT. NAME],   I.INVESTMENTID , I.[DESCRIPTION] AS [INVESTMENT NAME], I.AMOUNT AS BUDGET,
  I.ADDAMOUNT1 AS ADDITION, I.CANCELAMOUNT AS CANCEL,    I.NUMERIC1 AS [PR ON SAP], I.NUMERIC2 AS [PR ON EPS], (I.NUMERIC1 + I.NUMERIC2) AS [TOTAL PR],
  I.ADDAMOUNT2 AS [PO ON SAP],   I.PETTYCASH_AMOUNT AS [PO ON EPS], (I.ADDAMOUNT2 + I.PETTYCASH_AMOUNT) AS [TOTAL PO],    I.DIRECTPAYMENT_AMOUNT AS ACTUAL,
  I.REMAINAMOUNT  AS REMAINING
  FROM TM_INVESTMENT I
  LEFT JOIN TM_DEPARTMENT D ON I.DEPARTMENTID = D.DEPARTMENTID
  WHERE I.INVESTMENTID = @doc_num
  AND LEFT(I.PERIOD,4) = @period
  ORDER BY I.DEPARTMENTID



-- EXEC [wiss_sa_eps_report_budget_checking_investment] 'Y22IT017CO01' ,'SAP'

