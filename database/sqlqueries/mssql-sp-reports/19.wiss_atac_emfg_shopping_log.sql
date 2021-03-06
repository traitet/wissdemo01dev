USE [ATAC_ARISA_P02]
GO
/****** Object:  StoredProcedure [dbo].[wiss_atac_emfg_shopping_log]    Script Date: 24/05/2022 8:57:20 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =========================================================
-- [wiss_atac_emfg_operation_log]
-- Created by : Nuttawut
-- Created date : 23-05-2022
-- Updated date : 23-05-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_atac_emfg_shopping_log]

@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(30),
@max_record AS INT

AS

SELECT  DISTINCT  TOP(@max_record)
   CASE C.KANBANTYPECODE  WHEN '07' THEN 'SHOPPING' WHEN '10' THEN 'PACKING' ELSE '' END  AS OPERATION , A.SHIPDATE ,
A.PICKINGNUM , A.CUSTCODE , A.CUSTNAME , B.PARTCODE  , B.PARTNUM ,B.PARTNAME, B.CUSTPARTNUM ,B.CUSTQTYPACK, B.CUSTKANBANQTY , B.QTYPACK , CAST(D.NUMERIC1 AS INT) AS INTERNALKANBANID,
E.KANBANSERIAL
,D.EDITBY AS SCANBY , D.CREATEDATE AS SCANDATE, D.EDITTIME AS SCANTIME
FROM
LCTTPICKINH AS A
JOIN
LCTTPICKINL AS B
ON A.PICKINGNUM = B.PICKINGNUM
JOIN GBTTKANBANH  AS C
ON
C.PRODPLANNUM = A.PICKINGNUM

JOIN GBTTKANBANL  AS D

ON
C.GBTTKANBANHRID = D.GBTTKANBANHRID

JOIN  GBTTKANBANH AS E
ON E.GBTTKANBANHRID=D.NUMERIC1

WHERE
A.PICKINGNUM = @doc_num AND C.KANBANTYPECODE ='07' and SHIPDATE >=@start_date AND SHIPDATE <=@end_date
order by partcode ,SCANDATE ,scantime

