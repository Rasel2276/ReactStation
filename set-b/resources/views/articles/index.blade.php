<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Articles & Comments</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #f7f8fa;
            margin: 40px;
        }

        h1 {
            text-align: center;
            color: #b8860b;
            margin-bottom: 40px;
            font-weight: 600;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
            letter-spacing: 1px;
        }

        table {
            width: 85%;
            margin: 0 auto;
            border-collapse: collapse;
            border-radius: 16px;
            overflow: hidden;
            background: linear-gradient(145deg, #1b1b1b, #262626);
            color: #f1f1f1;
            box-shadow: 0 10px 25px rgba(0,0,0,0.35);
            position: relative;
            animation: glowPulse 4s infinite alternate;
        }

        th {
            background: linear-gradient(90deg, #b8860b, #ffd700);
            color: #1a1a1a;
            text-transform: uppercase;
            font-weight: 600;
            padding: 16px;
            letter-spacing: 1px;
            text-align: left;
        }

        td {
            padding: 14px 18px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background: rgba(255,215,0,0.08);
            transition: 0.3s ease;
        }

        ul {
            margin: 8px 0;
            padding-left: 20px;
        }

        ul li {
            list-style-type: square;
            color: #d4af37;
        }

        ul li::marker {
            color: #ffd700;
        }

        .no-comment {
            color: #ff7070;
            font-style: italic;
        }

        /* Glowing animated border */
        table::before {
            content: "";
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            border-radius: 18px;
            background: linear-gradient(120deg, #ffd700, #b8860b, #ffd700, #b8860b);
            background-size: 300% 300%;
            animation: borderGlow 6s linear infinite;
            z-index: -1;
            filter: blur(8px);
        }

        /* Keyframes for the border animation */
        @keyframes borderGlow {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Table breathing glow */
        @keyframes glowPulse {
            0% {
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.1);
            }
            100% {
                box-shadow: 0 0 35px rgba(255, 215, 0, 0.25);
            }
        }
    </style>
</head>
<body>
    <h1>🏆 Articles with Comments</h1>

    <table>
        <thead>
            <tr>
                <th>Article Name</th>
                <th>Details</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->name }}</td>
                    <td>{{ $article->details }}</td>
                    <td>
                        @if($article->comment->count() > 0)
                            <ul>
                                @foreach($article->comment as $cmt)
                                    <li>{{ $cmt->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="no-comment">No Comments</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
