CREATE TABLE author (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    biography TEXT,
    nationality VARCHAR(100),
    genre VARCHAR(50),
    birth_date DATETIME,
    death_date DATETIME
);

CREATE TABLE book (
    id INT AUTO_INCREMENT PRIMARY KEY,
    isbn VARCHAR(20) UNIQUE NOT NULL,
    title VARCHAR(255) NOT NULL,
    categories VARCHAR(255),
    status Enum('Available','Checked Out','Reserved','Under Maintenance') NOT NULL;
    publication_year DATETIME,
    number_available_copies INT NOT NULL,
    author_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES author(id)
);

CREATE TABLE member (
    id_member INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone_number VARCHAR(20)
);

CREATE TABLE borrow_record (
    id_borrow INT AUTO_INCREMENT PRIMARY KEY,
    id_book INT NOT NULL,
    id_member INT NOT NULL,
    borrow_date DATETIME NOT NULL,
    due_date DATETIME NOT NULL,
    return_date DATETIME,
    latefee FLOAT DEFAULT 0,
    FOREIGN KEY (id_book) REFERENCES book(id),
    FOREIGN KEY (id_member) REFERENCES member(id_member)
);

INSERT INTO author (name, nationality, genre, birth_date)
VALUES
('Robert C. Martin', 'American', 'Programming', '1952-12-05');

INSERT INTO book (isbn, title, categories, status, publication_year, number_available_copies, author_id)
VALUES
('9780132350884', 'Clean Code', 'Programming', 'available', '2008-01-01', 5, 1),
('9780137081073', 'Clean Architecture', 'Programming', 'available', '2017-01-01', 3, 1);

INSERT INTO member (full_name, email, phone_number)
VALUES ('Ahmed Benali', 'ahmed@mail.com', '0612345678');

INSERT INTO borrow_record (id_book, id_member, borrow_date, due_date, return_date, latefee)
VALUES (2,1,'2025-01-05 10:30:00','2025-01-19 23:59:59','2025-01-22 14:45:00', 15.50);