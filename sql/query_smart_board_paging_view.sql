SELECT smart_board_notice.id, smart_board_notice.subject, 
smart_board_notice.memo, 
smart_board_notice.member_id, smart_member.email,
smart_member.member_auth, smart_member.usrname, 
smart_board_notice.regidate, smart_board_notice.ip  
FROM smart_board_notice, smart_member 
WHERE smart_board_notice.member_id = smart_member.member_id 
ORDER BY regidate DESC
LIMIT 10 OFFSET 1