USE AGS_J614_614;
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- [wiss_sa_edrawing_authentication]
-- Created by : Nuttawut
-- Created date : 03-05-2022
-- Updated date : 03-05-2022
-- =========================================================
CREATE PROCEDURE [dbo].[wiss_sa_edrawing_authentication]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(8),
@record_count AS INT

AS
    SELECT top (@record_count)
        CHR_COD_UserID, CHR_COD_Password, CHR_NGP_LastLoginDate
    FROM dbo.TM_AGS_DRAWING_CTL_USER
    WHERE
        CHR_COD_UserID LIKE '%' +  @doc_num + '%' AND
        CHR_NGP_LastLoginDate >= @start_date AND
        CHR_NGP_LastLoginDate <= @end_date



-- EXEC [wiss_sa_edrawing_authentication] '20170914', '20220101','aunchulee_ph',100
