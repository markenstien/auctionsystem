CREATE TABLE payments(
    id int(10) not null primary key auto_increment,
    amount decimal(10,2),
    net_amount decimal(10,2),
    internal_remarks text,
    organization varchar(50),
    external_reference varchar(50),
    bidder_id int(10),
    seller_id int(10),
    date_time datetime
);


CREATE TABLE commissions(
    id int(10) not null primary key auto_increment,
    net_amount decimal(10,2),
    name varchar(250),
    payment_id int(10),
    bidder_id int(10),
    seller_id int(10),
    date_time datetime
);

ALTER TABLE bidding_tbl
    add column is_sent boolean default false;


ALTER TABLE payments
    add column livestock_id int(10);


truncate payments;
truncate commissions;
truncate bidding_tbl;
truncate livestock_tbl;