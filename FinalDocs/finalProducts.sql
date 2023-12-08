INSERT INTO Product
VALUES
('80439252', '30', 'Ground Coffee Beans', '20lbs of high quality Coffee Beans','20.99'),
('80439253', '10', 'Espresso Cups', 'Cups of Espresso, very high quality I swear', '10.99'),
('80439254', '10', 'Cute Aprons', 'Super stylish, and will make you super cute in the kitchen', '15.99'),
('80439255', '69', 'Half-Eaten Bread', 'We totally did not have one of our employees take a big bite out of this bread', '27.99'),
('80439256', '43', 'Ice Cubes', 'Premium ice cubes from the Pacific Ocean', '12.99'),
('56721469', '32', 'Vitamin C Tablets - Single', 'Single Serving health supplements because we do NOT go outside', '12.99'),
('68259786', '45', 'Nike Ankle Sock - Single', 'Probably the cheapest thing we sell here', '04.99'),
('32184672', '10', 'Fender Stratocaster - MIM', 'I dont know what this is but you should buy it because it will make me money', '90.99'),
('59813587', '14', 'Empty Water Bottle', 'I drank from this bottle, that is why it is so expensive', '17.99'),
('56842115', '89', 'Coffee Cake', 'Super Yummy Coffee Cake that is hand made from our kitchen in the store', '14.99'),
('11238962', '15', 'Fishing Rod','High-performance fishing rod with lightweight design', '89.99'),
('13457495', '50', 'Toaster', 'Stainless steel 4-slice toaster with adjustable toasting settings', '39.95'),
('28483748', '30', 'Headphones', 'Wireless over-ear headphones with noise cancellation', '96.00'),
('47392804', '40', 'Claning Robot', 'Wired vacuuming robot', '68.00'),
('74927933', '50', 'Ball Point Pen', 'The kind you write with, except it uses the blood of 19 babies from Poland', '99.99'),
('74928990', '20', 'Pencil Lead', 'Super Premium Pencil Lead from the Galapagos Islands','50.99'),
('74925583', '29', 'Mechanical Pencil', 'Vibranium Pencil for all your writing needs', '79.99'),
('74921439', '30', 'Number 2 Pencils', 'Basic pencil except we put the price up because I want more money', '25.99'),
('54256586', '45', 'McDonalds Cheeseburger', 'I just stole this from McDonalds, so hopefully I do not get in trouble for selling this', '10.99'),
('59874565', '86', 'Aarons Glasses', 'AGH WHO STOLE MY GLASSES I CANNOT SEE', '20.00');

INSERT INTO User VALUES('joshsmith@gmail.com', '8156872541', 'Josh Smith'), ('mjordan@gmail.com', '7042268722', 'Michael Jordan'), ('IAmCSCI240@gmail.com', '1112223333', 'Parker'),
('realperson@gmail.com', '8158974211', 'Silly Goose'), ('YippeeSkippee69@yahoo.com', '8659721617', 'Sully');

INSERT INTO Orders
VALUES('20283745', '178 Ooga Booga Blvd', '16.94', '1234567891234567', '2023-12-25', '6', 'YippeeSkippee69@yahoo.com'),
('56846658', '1450 W Northern St', '128.99', '6549875341654135', '2023-11-17', '5', 'joshsmith@gmail.com'),
('14283745', '1201 Apple Tree rd', '293.94', '4235759062038462', '2023-11-30', '4', 'mjordan@gmail.com'),
('19283745', '123 Fake St', '519.80', '1234789064038162', '2023-11-25', '20', 'IAmCSCI240@gmail.com'),
('84738502', '777 Road Rd', '139.99', '6543215965412356', '2023-10-3', '7', 'realperson@gmail.com');

INSERT INTO PlacedOrder
    VALUES ('mjordan@gmail.com', '14283745', '432156', 'Shipped');

INSERT INTO ProductStored
    VALUES ('14283745', '11238962', '1'),
           ('14283745', '13457495', '1'),
           ('14283745', '28483748', '1'),
           ('14283745', '47392804', '1');
