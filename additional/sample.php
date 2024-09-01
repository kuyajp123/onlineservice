SELECT pl.poll_id AS poll_id, 
       pl.user_no AS user_no, 
       u.fname AS fname, 
       u.lname AS lname,
       u.profilepicture,
       pl.question AS caption,
       po.options_id AS options_id,
       po.option_text,
       po.image_path,
       pv.vote_id,
       pv.user_no AS pv_user_no,
       pv.options_id AS pv_options_id,
       pv.voted_at,
       pl.created_at AS timestamp 
FROM polls pl
left JOIN user_registration u ON pl.user_no = u.user_no
left JOIN poll_options po ON pl.poll_id = po.poll_id
left JOIN poll_votes pv ON pl.user_no = pv.user_no
WHERE pl.poll_id = 14