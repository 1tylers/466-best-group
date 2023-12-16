CREATE TABLE Employees (
	EmpID CHAR(8) PRIMARY KEY,
	Password VARCHAR(15) NOT NULL UNIQUE
);

CREATE TABLE User (
	Email VARCHAR(40) PRIMARY KEY,
	Phone CHAR(10) UNIQUE,
	Name VARCHAR(30)
);

CREATE TABLE Product (
	ProductID CHAR(8) PRIMARY KEY,
	Quantity INT NOT NULL,
	Name VARCHAR(30) NOT NULL,
	Description VARCHAR(500),
	Price DECIMAL(4,2) NOT NULL
);

CREATE TABLE Orders (
	OrderID CHAR(8) PRIMARY KEY,
	Address VARCHAR(50) NOT NULL,
	Total DECIMAL(5,2) NOT NULL,
	BillingInfo CHAR(16) NOT NULL,
	Datee DATE NOT NULL,
	ItemCount INT NOT NULL,
	Email VARCHAR(40),
	FOREIGN KEY (Email) REFERENCES User(Email)
);

CREATE TABLE PlacedOrder (
	Email VARCHAR(40),
	OrderID CHAR(8),
	TrackingNo CHAR(6),
	Status VARCHAR(20),
	FOREIGN KEY (Email) REFERENCES User(Email),
	FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
	PRIMARY KEY (Email, OrderID)
);

CREATE TABLE ProductStored (
	OrderID CHAR(8),
	ProductID CHAR(8),
	Quantity INT NOT NULL,
	FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
	FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
	PRIMARY KEY (OrderID, ProductID)
);

